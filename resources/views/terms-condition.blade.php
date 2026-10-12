@include('Include.header')
<style>
    /* TERMS PAGE */
.terms-section {
    background: #f7f9fc;
}

.terms-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 40px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
}

.terms-header {
    border-bottom: 1px solid #eee;
    margin-bottom: 25px;
}

.updated-date {
    font-size: 14px;
    color: #777;
}

.terms-body h3 {
    font-size: 22px;
    margin-top: 30px !important;
    margin-bottom: 2px;
    font-weight: 600;
    color: #111;
}

.terms-body h5 {
    font-size: 16px;
    font-weight: 600;
    margin-top: 18px;
    color: #333;
}

.terms-body p,
.terms-body li {
    font-size: 15.5px;
    line-height: 1.75;
    color: #555;
}

.terms-body ul {
    padding-left: 20px;
}

.terms-body hr {
    margin: 30px 0;
    border-color: #e5e5e5;
}

/* Banner */
.inner-title {
    color: #fff;
    font-size: 42px;
    font-weight: 700;
}

.breadcrumb-wrapper {
    margin-top: 10px;
    font-size: 14px;
    color: #eee;
}

.breadcrumb-wrapper a {
    color: #fff;
    text-decoration: none;
}


</style>
<main>

    <!-- Banner -->
    <section class="banner inner-banner d-flex align-items-center"
        style="background-image:url('{{ asset('assets/images/inner-banner.jpg') }}');">
        <div class="container text-center">
            <h1 class="inner-title">Terms & Conditions</h1>
            <nav class="breadcrumb-wrapper">
                <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                <span>/</span>
                <span>Terms & Conditions</span>
            </nav>
        </div>
    </section>

    <!-- Terms Content -->
    <section class="terms-section py-5">
        <div class="container">
            <div class="terms-card">

                <div class="terms-header">
                    <p class="updated-date">
                        <strong>Last Updated:</strong> {{ date('F d, Y') }}
                    </p>
                </div>

                <div class="terms-body">

                    <p>
                        These Terms and Conditions ("Terms") govern your access to and use of
                        <strong>maseco.ca</strong>, owned and operated by
                        <strong>Maseco Design Technologies Inc.</strong>.
                    </p>

                    <p>
                        By accessing or using the Platform, you agree to be legally bound by these Terms.
                        If you do not agree, you must not use the Platform.
                    </p>

                    <hr>

                    <h3>1. About the Platform</h3>
                    <p>
                        Maseco operates a technology-enabled marketplace designed to support designers,
                        suppliers, and manufacturers with sustainable sourcing, AI-powered tools, and
                        post-production services.
                    </p>

                    <h3>2. Eligibility & Accounts</h3>

                    <h5>2.1 Eligibility</h5>
                    <p>You must be at least 18 years old and legally capable of entering contracts.</p>

                    <h5>2.2 Account Registration</h5>
                    <p>
                        Users must provide accurate and current information and are responsible for
                        maintaining account security.
                    </p>

                    <h5>2.3 Account Types</h5>
                    <ul>
                        <li>Designers</li>
                        <li>Sustainable Raw Material Suppliers</li>
                        <li>Manufacturers</li>
                    </ul>

                    <h3>3. Subscriptions & Payments</h3>
                    <p>
                        Maseco offers multiple subscription plans. Fees, commissions, and taxes are
                        non-refundable unless stated otherwise.
                    </p>

                    <h3>4. Marketplace Transactions</h3>
                    <p>
                        Maseco acts solely as a technology facilitator. Contracts are directly between users.
                    </p>

                    <h3>5. AI Tools Disclaimer</h3>
                    <p>
                        AI-generated recommendations are informational only and do not replace professional
                        judgment.
                    </p>

                    <h3>6. Intellectual Property</h3>
                    <p>
                        All Platform content and technology belong to Maseco unless otherwise stated.
                    </p>

                    <h3>7. Confidentiality</h3>
                    <p>
                        All user data is treated as confidential subject to legal requirements.
                    </p>

                    <h3>8. Prohibited Conduct</h3>
                    <ul>
                        <li>Violation of laws</li>
                        <li>False or misleading content</li>
                        <li>Security interference</li>
                    </ul>

                    <h3>9. Termination</h3>
                    <p>
                        Accounts may be suspended or terminated for violations or harmful activity.
                    </p>

                    <h3>10. Liability Disclaimer</h3>
                    <p>
                        The Platform is provided “as is” without warranties of any kind.
                    </p>

                    <h3>11. Governing Law</h3>
                    <p>
                        These Terms are governed by the laws of Ontario, Canada.
                    </p>

                    <h3>12. Contact Information</h3>
                    <p>
                        <strong>Maseco Design Technologies Inc.</strong><br>
                        Website: <a href="https://maseco.ca" target="_blank">maseco.ca</a><br>
                        Email: <a href="mailto:connect@maseco.ca">connect@maseco.ca</a>
                    </p>

                </div>
            </div>
        </div>
    </section>

</main>

@include('Include.footer')
