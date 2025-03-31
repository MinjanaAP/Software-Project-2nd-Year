 function validatePassword(password) {
    let message = '';

    //check length
    if (password.length < 6) {
        message += 'Password must be at least 8 characters long. ';
    }

    //check upper case
    if (!/[A-Z]/.test(password)) {
        message += 'Password must contain at least one upper case letter. ';
    }

    //check lower case   
    if (!/[a-z]/.test(password)) {
        message += 'Password must contain at least one lower case letter. ';
    }

    //check number or special character
    if (!/\d|\W/.test(password)) {
        message += 'Password must contain at least one number or special character. ';
    }

    return message;
}