<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>CezAgora</title>
    </head>
    <body>
        <section style="max-width: 640px; padding: 24px; margin: auto; background-color: white;">
            <header style="text-align: center; margin-bottom: 24px;">
                <a href="https://www.cezagora.com">
                    <img style="width: 288px; height: auto;" src="https://cezagora.fra1.cdn.digitaloceanspaces.com/logo.png" alt="CezAgora Logo">
                </a>

                <nav style="margin-top: 24px;">
                    <a href="https://www.cezagora.com" style="color: #2563eb; text-decoration: none; padding: 8px;"
                       aria-label="Reddit"> Home </a>
                    <a href="https://www.cezagora.com/help" style="color: #2563eb; text-decoration: none; padding: 8px;"
                       aria-label="Reddit"> Help </a>
                    <a href="https://www.cezagora.com/contact"
                       style="color: #2563eb; text-decoration: none; padding: 8px;" aria-label="Reddit"> Contact </a>
                </nav>
            </header>

            <main>
                <img style="width: 100%; height: auto; object-fit: cover; border-radius: 8px;"
                     src="https://t3.ftcdn.net/jpg/02/86/03/88/240_F_286038864_A5gW3dZMOjWH5YsETozisZ91DA3joClp.jpg"
                     alt="">

                <h2 style="color: #374151; font-size: 24px; font-weight: bold; margin-top: 24px;">Hello {{ $user->first_name}},</h2>

                <p style="margin-top: 8px; color: #4b5563; line-height: 24px;">
                    We're delighted to welcome you to CezAgora, the dedicated hub made for cosmetics. As a professional within the cosmetics industry, you're now in the perfect place to discover and connect with manufacturers, distributors, and innovators.
                </p>
                <p style="margin-top: 8px; color: #4b5563; line-height: 24px;">
                    Embrace the world of cosmetics like never before with CezAgora. Start by exploring our extensive range of products and services designed to empower your business, from high-quality raw materials to cutting-edge marketing services.
                </p>

                <p style="margin-top: 8px; color: #4b5563; line-height: 24px;">
                    Thanks, <br>
                    CezAgora Team
                </p>

                <a href="https://www.cezagora.com/login"
                   style="background-color: #2563eb; color: white; padding: 12px 24px; text-decoration: none; border-radius: 8px; font-weight: 500; margin-top: 32px; display: inline-block;">Login</a>
            </main>

            <footer style="margin-top: 24px;">
                <p style="color: #6b7280; font-size: 14px;">Committed to Your Privacy</p>
                <p style="color: #6b7280; font-size: 14px;">Your privacy and data security are paramount to us. All information on our platform is treated with the highest standard of confidentiality and is fully compliant with data protection regulations.</p>

                <p style="color: #6b7280; font-size: 14px;">© {{\Carbon\Carbon::now()->year}} <a
                        href="https://cezius.tech">Cezius Link™</a>. All Rights Reserved.</p>
            </footer>
        </section>
    </body>
</html>
