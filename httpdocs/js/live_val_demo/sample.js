// LV Demo

// Required
var val_effdate = new LiveValidation('effdate', { validMessage: " ", onlyOnSubmit: true});
val_effdate.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */

// Required and exlude certain chars
var val_first_name = new LiveValidation('first_name', { validMessage: " ", onlyOnSubmit: true});
val_first_name.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */
val_first_name.add(Validate.Exclusion, {failureMessage: " ", within: [ '1' , '2' , '3' , '4' , '5' , '6' , '7' , '8' , '9' , '0' , '~' , '_' , ')' , '(' , '?' , '$' , '<' , '>' , ',' , '}' , '{' , '[' , ']' , '%' , '@' , '&' , '*' , ':', ';' , '\\', '|', '^', '!' , '+' , '='], partialMatch: true });

// Email Validation
var val_email = new LiveValidation("emailadd", { validMessage: " ", onlyOnSubmit: true});
val_email.add(Validate.Email, {failureMessage: " "});

// Zip Code Validation (Required, Exclude, Minimum)
var val_zip = new LiveValidation('zip_code', { validMessage: " ", onlyOnSubmit: true});
val_zip.add(Validate.Presence, {failureMessage: " "}); /* Must exist (required) */
val_zip.add(Validate.Exclusion, {failureMessage: " ", within: [ '~' , '_' , ')' , '(' , '?' , '$' , '<' , '>', ',' , '}' , '{' , '[' , ']' , '%' , '@' , '&' , '*' , ':', ';' , '\\', '|', '^', '!' , '+' , '='], partialMatch: true });
val_zip.add(Validate.Length, {minimum: 5, tooShortMessage: " "}); /* Must be at least 5 char */