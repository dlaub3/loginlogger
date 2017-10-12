const validation = (function() {

  let validatePassword = function(password, options) {
    let error = [];
    if (!has_length_greater_than(password, options['min'])) {
      error.push(`Password must be great than ${options['min']}`);
      error.push(`Password must be great than ${options['min']}`);
    }
    if (!has_length_less_than(password, options['max'])) {
      error.push(`Password must be less than ${options['max']}`);
    }
    if (error.length === 0) {
      return true;
    }
    return error;
  };

  let has_length_greater_than = function(str, len) {
    return str.length > len;
  };

  let has_length_less_than = function(str, len) {
    return str.length < len;
  };
  // function has_inclusion_of($value, $set)
  // {
  //
  // }
  //
  // function has_exclusion_of($value, $set)
  // {
  //
  // }

  let has_valid_email_format = function(email) {
    let regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    let value = email.match(regex);
    return value === email;
  };

  return {validatePassword: validatePassword};
})();

module.exports = validation;
