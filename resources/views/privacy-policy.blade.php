@include('Include.header')

<main>

    <!-- Banner -->
    <section class="banner inner-banner d-flex align-items-center"
        style="background-image:url('{{ asset('public/assets/images/inner-banner.jpg') }}');">
        <div class="container text-center">
            <h1 class="inner-title">Privacy Policy</h1>
            <nav class="breadcrumb-wrapper">
                <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Home</a>
                <span>/</span>
                <span>Privacy Policy</span>
            </nav>
        </div>
    </section>

    <!-- Privacy Policy Content -->
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
                        This Privacy Policy explains how
                        <strong>Maseco Design Technologies Inc.</strong> ("Maseco", "we", "us", or "our")
                        collects, uses, discloses, and protects personal information in compliance
                        with the <strong>Personal Information Protection and Electronic Documents Act (PIPEDA)</strong>
                        and applicable Canadian privacy laws.
                    </p>

                    <hr>

                    <h3>1. Information We Collect</h3>

                    <h5>1.1 Personal Information</h5>
                    <ul>
                        <li>Name, email address, and phone number</li>
                        <li>Account credentials</li>
                        <li>Business and company details</li>
                        <li>Billing and payment information</li>
                    </ul>

                    <h5>1.2 Usage and Technical Data</h5>
                    <ul>
                        <li>IP address, device type, and browser information</li>
                        <li>Log files and usage analytics</li>
                        <li>Interactions with AI tools and Platform features</li>
                    </ul>

                    <h5>1.3 Uploaded Content</h5>
                    <p>
                        Designs, specifications, communications, and files uploaded to the Platform.
                    </p>

                    <h3>2. How We Use Information</h3>
                    <p>We use personal information to:</p>
                    <ul>
                        <li>Operate and maintain the Platform</li>
                        <li>Connect designers, suppliers, and manufacturers</li>
                        <li>Process payments and manage subscriptions</li>
                        <li>Improve AI tools and Platform performance</li>
                        <li>Communicate important updates</li>
                        <li>Meet legal and regulatory obligations</li>
                    </ul>

                    <h3>3. AI and Automated Processing</h3>
                    <p>
                        Information may be processed using automated systems and machine learning
                        models to deliver recommendations and improve services. Aggregated and
                        anonymized data may be used for analytics and improvement purposes.
                    </p>

                    <h3>4. Sharing of Information</h3>
                    <p>We may share personal information:</p>
                    <ul>
                        <li>With other users to facilitate transactions</li>
                        <li>With trusted service providers and partners</li>
                        <li>When required by law or legal process</li>
                    </ul>

                    <p><strong>We do not sell personal information.</strong></p>

                    <h3>5. Data Storage and Security</h3>
                    <p>
                        Personal data is stored on secure systems protected by appropriate technical,
                        administrative, and physical safeguards.
                    </p>

                    <h3>6. International Data Transfers</h3>
                    <p>
                        Information may be stored or processed outside Canada. By using the Platform,
                        you consent to such international transfers.
                    </p>

                    <h3>7. Data Retention</h3>
                    <p>
                        We retain personal information only for as long as necessary or legally required.
                    </p>

                    <h3>8. Your Rights</h3>
                    <p>
                        You may request access, correction, or deletion of your personal information,
                        subject to applicable laws.
                    </p>

                    <h3>9. Cookies and Tracking</h3>
                    <p>
                        We use cookies and similar technologies to enhance user experience and analyze
                        Platform usage. Cookie preferences can be managed via your browser settings.
                    </p>

                    <h3>10. Third-Party Links</h3>
                    <p>
                        The Platform may link to third-party websites. Maseco is not responsible for
                        their privacy practices.
                    </p>

                    <h3>11. Policy Updates</h3>
                    <p>
                        This Privacy Policy may be updated periodically. Continued use of the Platform
                        signifies acceptance of the updated policy.
                    </p>

                    <h3>12. Contact Information</h3>
                    <p>
                        <strong>Privacy Officer</strong><br>
                        Maseco Design Technologies Inc.<br>
                        Email: <a href="mailto:info@maseco.ca">connect@maseco.ca</a>
                    </p>

                    <hr>

                    <p class="text-muted small">
                        This Privacy Policy is provided for general informational purposes only and does
                        not constitute legal advice. Please consult qualified Canadian legal counsel
                        before relying on this document.
                    </p>

                </div>
            </div>
        </div>
    </section>

</main>

@include('Include.footer')
