(function () {
    const timers = new WeakMap();
    const textFilterSelector = 'input[type="search"], input[type="text"], input:not([type])';

    function isFilterControl(control) {
        const identity = [control.id, control.name, control.className]
            .filter(Boolean)
            .join(' ')
            .toLowerCase();

        if (/\breport-type\b/.test(identity)) return false;

        return control.type === 'date'
            || /search|filter|status|type|category|certification|source|method|payment|start-date|end-date|from-date|to-date/.test(identity);
    }

    function applyFilter(control, activateButton) {
        const page = control.closest('.page-content') || document;
        const form = control.closest('form');
        const formButton = form && form.querySelector('button[type="submit"], input[type="submit"]');
        const button = formButton || page.querySelector(
            '[id$="-filter-btn"], [id$="-filter-button"], [id^="apply-"][id$="-filters"], #apply-filters, #applyFilters'
        );

        applyTableFilters(page);

        if (activateButton && button && !button.disabled) {
            button.click();
        }
    }

    function selectDataKey(select) {
        const key = (select.id + ' ' + select.name).toLowerCase();
        return /certification/.test(key) ? 'certification'
            : /source/.test(key) ? 'source'
            : /billing|type/.test(key) ? 'type'
            : /category/.test(key) ? 'category'
            : /payment|provider|method/.test(key) ? 'payment'
            : /materials-status/.test(key) ? 'stockStatus'
            : 'status';
    }

    function selectColumn(select, headers) {
        const key = (select.id + ' ' + select.name).toLowerCase();
        const pattern = /source/.test(key) ? /source|reference/
            : /billing/.test(key) ? /type|billing|duration/
            : /payment|provider|method/.test(key) ? /payment|provider|method/
            : /type|category|role/.test(key) ? /type|category|role|name/
            : /certification/.test(key) ? /certification/
            : /stock/.test(key) ? /stock|availability/
            : /status/.test(key) ? /status/
            : null;
        return pattern ? headers.findIndex(function (header) { return pattern.test(header); }) : -1;
    }

    function addDataOptions(page, rows, headers) {
        const selects = Array.from(page.querySelectorAll('select')).filter(isFilterControl);
        selects.forEach(function (select) {
            if (/page-size|length/.test(select.id + ' ' + select.name)) return;
            const dataKey = selectDataKey(select);
            const column = selectColumn(select, headers);
            const values = new Set();
            rows.forEach(function (row) {
                const value = (row.dataset[dataKey] || (column >= 0
                    ? Array.from(row.querySelectorAll('td'))[column]?.textContent
                    : '') || '').trim();
                if (value && value !== '—' && value !== '-') values.add(value.toLowerCase());
            });
            const existing = new Set(Array.from(select.options).map(function (option) {
                return option.value.trim().toLowerCase();
            }));
            values.forEach(function (value) {
                if (existing.has(value)) return;
                const option = document.createElement('option');
                option.value = value;
                option.textContent = value.replace(/[_-]+/g, ' ').replace(/\b\w/g, function (letter) {
                    return letter.toUpperCase();
                });
                select.appendChild(option);
            });
        });
    }

    function filterRows(page, sourceRows) {
        const table = page.querySelector('.page-content table, table');
        if (!table) return sourceRows;
        const headers = Array.from(table.querySelectorAll('thead th'))
            .map(function (header) { return header.textContent.trim().toLowerCase(); });
        addDataOptions(page, sourceRows, headers);
        const controls = Array.from(page.querySelectorAll('input, select')).filter(isFilterControl);
        const text = controls.find(function (control) {
            return control.matches(textFilterSelector) && /search/i.test(control.id + ' ' + control.name);
        });
        const selects = controls.filter(function (control) {
            return control instanceof HTMLSelectElement && !/page-size|length/i.test(control.id + ' ' + control.name);
        });
        const start = controls.find(function (control) { return control.type === 'date' && /start|from/i.test(control.id + ' ' + control.name); });
        const end = controls.find(function (control) { return control.type === 'date' && /end|to/i.test(control.id + ' ' + control.name); });
        const searchTerm = text ? text.value.trim().toLowerCase() : '';

        function findColumn(pattern) {
            return headers.findIndex(function (header) { return pattern.test(header); });
        }

        function cellText(row, index) {
            const cells = row.querySelectorAll('td');
            return index >= 0 && cells[index] ? cells[index].textContent.trim().toLowerCase() : '';
        }

        function dateValue(row, index) {
            const rawDate = row.getAttribute('data-date') || cellText(row, index);
            const parsed = Date.parse(rawDate);
            return Number.isNaN(parsed) ? null : new Date(parsed);
        }

        const dateColumn = findColumn(/date|created|registered|submitted|updated|joined/);
        const startDate = start && start.value ? new Date(start.value + 'T00:00:00') : null;
        const endDate = end && end.value ? new Date(end.value + 'T23:59:59.999') : null;
        return sourceRows.filter(function (row) {
            let matches = !searchTerm || row.textContent.toLowerCase().includes(searchTerm);

            selects.forEach(function (select) {
                const value = select.value.trim().toLowerCase();
                if (!value) return;
                const column = selectColumn(select, headers);
                const dataKey = selectDataKey(select);
                const rowValue = (row.dataset[dataKey] || cellText(row, column)).toLowerCase();
                const optionLabel = select.selectedOptions && select.selectedOptions[0]
                    ? select.selectedOptions[0].textContent.trim().toLowerCase()
                    : '';
                const normalizedValue = value.replace(/_/g, ' ');
                if (column >= 0 || row.dataset[dataKey]) {
                    if (![value, normalizedValue, optionLabel].some(function (candidate) {
                        return candidate && (rowValue === candidate || rowValue.includes(candidate));
                    })) matches = false;
                }
            });

            if (matches && (startDate || endDate)) {
                const rowDate = dateValue(row, dateColumn);
                if (!rowDate || (startDate && rowDate < startDate) || (endDate && rowDate > endDate)) matches = false;
            }

            return matches;
        });
    }

    window.dashboardFilterRows = filterRows;

    function applyTableFilters(page) {
        const table = page.querySelector('.page-content table, table');
        if (!table) return;
        const rows = Array.from(table.querySelectorAll('tbody tr'));
        const dataRows = rows.filter(function (row) {
            return !row.querySelector('td[colspan]') && !/empty-row|no-results/i.test(row.className);
        });
        const filteredRows = new Set(filterRows(page, dataRows));

        rows.forEach(function (row) {
            if (row.querySelector('td[colspan]') || /empty-row|no-results/i.test(row.className)) {
                row.hidden = filteredRows.size > 0;
            } else {
                row.hidden = !filteredRows.has(row);
            }
        });
    }

    document.addEventListener('input', function (event) {
        const control = event.target;
        if (!(control instanceof HTMLInputElement) || !isFilterControl(control)) return;
        if (!control.matches(textFilterSelector)) return;

        window.clearTimeout(timers.get(control));
        timers.set(control, window.setTimeout(function () {
            const form = control.closest('form[data-auto-filter="true"]');
            applyFilter(control, !control.closest('form') || Boolean(form));
        }, 250));
    });

    document.addEventListener('change', function (event) {
        const control = event.target;
        if (!(control instanceof HTMLInputElement || control instanceof HTMLSelectElement)) return;
        if (!isFilterControl(control)) return;

        window.clearTimeout(timers.get(control));
        applyFilter(control, true);
    });

    document.addEventListener('click', function (event) {
        const button = event.target.closest('[id$="-filter-btn"], [id$="-filter-button"], [id^="apply-"][id$="-filters"], #apply-filters, #applyFilters');
        if (button) {
            const page = button.closest('.page-content') || document;
            const hasPaginatedRenderer = page.querySelector(
                '#contact-pagination, #newsletter-pagination, #enquiry-pagination, #payments-pagination'
            );
            if (!hasPaginatedRenderer) applyTableFilters(page);
        }
    });
})();
