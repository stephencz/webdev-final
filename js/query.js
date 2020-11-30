URL = "sheet.php"

/** @returns The sex of the user (male or female). */
function get_sex() {
    return $('input[name="sex"]:checked').val();
}

/** @returns The age of the user (integer > 0). */
function get_age() {
    return $('input[id="age"]').val();
}

/** @returns The height of the user in inches. */
function get_height() {
    return $('select[id="height"]').val();
}

/** @returns The weight of the user in lbs. */
function get_weight() {
    return $('input[id="weight"]').val();
}

/**
 * Generates a query string, and alerts the user if an error occurs.
 * @returns A query string.
 */
function get_query_string() {
    var query = "?";

    //Get sex and verify that it is valid input.
    var sex = get_sex();
    if(sex != undefined) {
        query += "sex=" + sex; 
    
    } else {
        alert("Please select a sex!")
        return;
    }

    //Get age and verify that it is valid input
    var age = get_age();
    if(age) {
        //Testing to make sure age is a number and greater than 0.
        if(/^\d+$/.test(age) && parseInt(age) > 0) {
            query += "&age=" + age;
        } else {
            alert("Age must be a number greater than 0!")
            return;
        }
    } else {
        alert("Please input an age!");
        return;
    }

    //Get height and verify that it is valid input
    var height = get_height();
    if(height != undefined && height > 0){
        query += "&height=" + height;
    } else {
        alert("Please select a height!");
        return
    }

    var weight = get_weight();
    if(weight) {
        //Testing to make sure age is a number and greater than 0.
        if(/^\d+$/.test(weight) && parseInt(weight) > 0) {
            query += "&weight=" + weight;
        } else {
            alert("Age must be a whole number greater than 0!")
            return;
        }
    } else {
        alert("Please input a weight!");
        return;
    }

    return query;
}

/**
 * Opens the fact sheet page and passes along the query parameters.
 */
function open_fact_sheet() {
    var query = get_query_string();
    console.log(query)
    if(query) {
        window.open(URL + query);
    }

    return;
}