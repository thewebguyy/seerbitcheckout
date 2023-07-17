function handleFormSubmission(event) {
    event.preventDefault(); // Prevent form submission
  
    var amountInput = document.getElementsByName('amount')[0];
    var currencyInput = document.getElementsByName('currency')[0];
  
    var publicKey = 'SBPUBK_DQ24K6T5TI1WOAOYPWWYMGMHKDRVEGPW';
    var amount = amountInput.value;
    var currency = currencyInput.value;
  
    // Encrypt the sensitive data
    var encryptedData = encryptData(publicKey, amount, currency);
  
    // Make an AJAX request to initialize the transaction
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'checkout.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
  
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          handlePaymentInitializationResponse(response);
        } else {
          handlePaymentInitializationError(xhr.status);
        }
      }
    };
  
    xhr.send(JSON.stringify(encryptedData));
  }
  
  function encryptData(publicKey, amount, currency) {
    // Implement encryption logic here
    // Encrypt the sensitive data before sending to SeerBit
    // Return the encrypted data
  
    var encryptedAmount = encrypt(amount);
    var encryptedCurrency = encrypt(currency);
  
    return {
      publicKey: publicKey,
      encryptedAmount: encryptedAmount,
      encryptedCurrency: encryptedCurrency
      // Add other encrypted form field values
    };
  }
  
  function encrypt(value) {
    // Implement encryption logic here
    // Encrypt the given value
    // Return the encrypted value
  
    // Placeholder: Add your encryption implementation or library here
    return value;
  }
  
  function handlePaymentInitializationResponse(response) {
    if (response.status === 'SUCCESS') {
      var redirectLink = response.data.payments.redirectLink;
      // Redirect the customer to the SeerBit checkout modal
      window.location.href = redirectLink;
    } else {
      // Handle error response
      console.error(response.message);
      // Display error message to the user (optional)
      showErrorToUser(response.message);
    }
  }
  
  function handlePaymentInitializationError(status) {
    // Handle various error scenarios
    if (status === 401) {
      console.error('Unauthorized request.');
      // Display error message to the user (optional)
      showErrorToUser('Unauthorized request.');
    } else if (status === 408) {
      console.error('Request timed out.');
      // Display error message to the user (optional)
      showErrorToUser('Request timed out.');
    } else {
      console.error('An error occurred during payment initialization.');
      // Display error message to the user (optional)
      showErrorToUser('An error occurred during payment initialization.');
    }
  }
  
  function showErrorToUser(errorMessage) {
    // Display the error message to the user
    // You can show it in an alert, toast, or any other UI element
    // For example:
    var errorElement = document.getElementById('error-message');
    errorElement.textContent = errorMessage;
    errorElement.style.display = 'block';
  }
  
  document.getElementById('checkout-form').addEventListener('submit', handleFormSubmission);
  