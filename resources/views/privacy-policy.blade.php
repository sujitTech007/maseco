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
            <h1 class="inner-title">Privacy Policy</h1>
            <nav class="breadcrumb-wrapper">
                <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
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
                        Email: <a href="mailto:connect@maseco.ca">connect@maseco.ca</a>
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
