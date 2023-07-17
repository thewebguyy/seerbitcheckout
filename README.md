# seerbitcheckout

# SeerBit Standard Checkout Integration

This project demonstrates the integration of SeerBit Standard Checkout API into a simple checkout form. It allows you to collect payment details from customers and initiate the payment process using SeerBit.

## Features

- Collects customer payment details including amount and currency.
- Encrypts sensitive data before sending it to SeerBit for security.
- Handles the initialization of the payment transaction using AJAX.
- Redirects the customer to the SeerBit checkout modal for payment processing.
- Handles success and error responses from SeerBit during the payment initialization process.
- Displays error messages to the user if any errors occur.
- Includes a progress bar to indicate the customer's progress in the checkout process.

## Prerequisites

To run this project, you need:

- A web server (e.g., Apache, Nginx) to host the files.
- A compatible version of PHP installed on your server.
- Your SeerBit merchant public key to configure the integration. Replace `'SBPUBK_DQ24K6T5TI1WOAOYPWWYMGMHKDRVEGPW'` with your actual public key in the `index.html` and `script.js` files.

## Getting Started

1. Clone this repository or download the project files.
2. Copy the files to your web server directory.
3. Update the SeerBit merchant public key in the `index.html` and `script.js` files.
4. Access the `index.html` file through your web server URL to start using the checkout.

## File Structure

- `index.html`: The main HTML file containing the checkout form and JavaScript integration code.
- `style.css`: CSS file for styling the checkout form and progress bar.
- `script.js`: JavaScript file for handling form submission, encryption, AJAX request, and response handling.
- `checkout.php`: PHP file for processing the payment initialization request and interacting with SeerBit API.

## Customization

- Feel free to modify the HTML and CSS files to match your branding and design requirements.
- Update the PHP file (`checkout.php`) as per your specific business logic and interaction with SeerBit API.

## License

This project is licensed under the [MIT License](LICENSE).

