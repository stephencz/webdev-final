/**
 * Create by Stephen Czekalski
 * December 1, 2020
 */

function get_bmr(sex, age, weight, height) {
    var kg = weight / 2.205;
    var centi = height * 2.54;

    if(sex === "male") {
        return ((10 * kg) + (6.25 * centi)) - ((5 * age) + 5);

    } else {
        return ((10 * kg) + (6.25 * centi)) - ((5 * age) - 161);
    }
}

function create_projection_chart() {
    var urlQueryParams = new URLSearchParams(window.location.search);

    // Get user info from query parameters
    var sex = urlQueryParams.get('sex');
    var age = parseInt(urlQueryParams.get('age'));
    var weight = parseInt(urlQueryParams.get('weight'));
    var height = parseInt(urlQueryParams.get('height'));
    var goal = parseInt($("#goal-weight").val());
    var calories_out = parseInt($("#calorie-expenditure").val());
    var calories_in = parseInt($("#calorie-deficit").val());

    // Test calories in and calories out to make sure they are valid.
    // Warn the user if they are not.
    if(!isNaN(calories_in) && !isNaN(calories_out)) {
        if(calories_in > 0 && calories_out > 0 && calories_in >= calories_out) {
            alert("Your calorie deficit MUST be smaller than your expenditure!");
            return;
        }
    } else {
        alert("Please enter BOTH calorie expenditure and calorie deficit!");
        return;
    }

    // Test to make sure goal weight is valid input.
    if(isNaN(goal)) {
        alert("Please enter a goal weight!");
        return;
    } 

    if(goal >= weight || goal <= 0) {
        alert("Please enter a goal weight less than your current weight and greater than 0.");
        return;
    } 

    console.log("Goal: " + goal);

    // If the input is valid than simulate a person losing weight at the
    // passed in deficit record the data to an array.
    var weight_data = []
    var expenditure_data = []
    var deficit_data = []
    var last_weight = weight;

    // Convert weight to calories
    var weight_in_calories = weight * 3500;
    var goal_in_calories = goal * 3500;

    // While the user's weight in calories is greater than their
    // goal weight.
    while(weight_in_calories > goal_in_calories) {

        //Calculate the user's currrent bmr
        let bmr = get_bmr(sex, age, last_weight, height);

        // Subtract the calorie diffrence from the user's
        // total weight in calories.
        weight_in_calories -= calories_out - calories_in;
        
        // Convert the user's weight back into lbs
        // and push it onto the weight data array.
        let new_weight = (weight_in_calories / 3500).toFixed(2);
        weight_data.push(new_weight);
        expenditure_data.push(calories_out.toFixed(2))
        deficit_data.push(calories_in.toFixed(2));        
       

        //Calculate the bmr of the new weight.
        let new_bmr = get_bmr(sex, age, new_weight, height);
        

        //Get the difference between the old bmr and the new bmr.
        let bmr_delta = bmr - new_bmr;

        calories_out -= bmr_delta;
        calories_in -= bmr_delta;

        last_weight = new_weight;

    }

    // Cleaned Data Arrays
    var cleaned_weight_data = [];
    var cleaned_expenditure_data = [];
    var cleaned_deficit_data = [];

    var label_data = [];

    for(var i = 0; i < weight_data.length; i++) {
        if((i % 14) == 0) {
            cleaned_weight_data.push(weight_data[i]);
            cleaned_expenditure_data.push(expenditure_data[i]);
            cleaned_deficit_data.push(deficit_data[i]);

            label_data.push("Week " + i / 7);
        }   
    }

    //Generate Weight chart using Chart.js
    var weightCtx = document.getElementById('weight-chart').getContext('2d');
    var weightChart = new Chart(weightCtx, {
        // The type of chart we want to create
        type: 'line',
        data: {
            labels: label_data,
            datasets: [{
                label: 'Weight Overtime',
                backgroundColor: '#b51313',
                borderColor: '#343a40',
                data: cleaned_weight_data
            }],
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMin: goal - 10,
                        suggestedMax: weight + 10
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true,
                        min: 0,
                        max: weight_data.length + 14,
                        stepSize: 14
                    }
                }]
            }
        }
    });

    //Generate Weight chart using Chart.js
    var expenditureCtx = document.getElementById('expenditure-chart').getContext('2d');
    var expenditureChart = new Chart(expenditureCtx, {
        // The type of chart we want to create
        type: 'line',
        data: {
            labels: label_data,
            datasets: [{
                label: 'Calories Expended',
                backgroundColor: '#28a745',
                borderColor: '#343a40',
                data: cleaned_expenditure_data
            }],
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMin: expenditure_data[expenditure_data.length - 1] - 20,
                        suggestedMax: expenditure_data[0] + 20
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true,
                        min: 0,
                        max: expenditure_data.length + 14,
                        stepSize: 14
                    }
                }]
            }
        }
    });

    //Generate Weight chart using Chart.js
    var deficitCtx = document.getElementById('deficit-chart').getContext('2d');
    var deficitChart = new Chart(deficitCtx, {
        // The type of chart we want to create
        type: 'line',
        data: {
            labels: label_data,
            datasets: [{
                label: 'Calorie Deficit',
                backgroundColor: '#007bff',
                borderColor: '#343a40',
                data: cleaned_deficit_data
            }],
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMin: deficit_data[deficit_data.length - 1] - 20,
                        suggestedMax: deficit_data[0] + 20
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true,
                        min: 0,
                        max: deficit_data.length + 14,
                        stepSize: 14
                    }
                }]
            }
        }
    });
  }