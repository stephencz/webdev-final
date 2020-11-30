<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Body Weight Fact Sheets</title>
    <meta name="author" content="Stephen Czekalski">

    <!-- Link to Bootstrap's CSS -->
    <link rel="stylesheet" 
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" 
        crossorigin="anonymous">

    <link rel="stylesheet" href="css/styles.css">

</head>
<body>

    <?php require("php/weight.php"); ?>
    <?php require("includes/header.html"); ?>

    <div class="sheet-wrapper">
        <div class="container">
            <div class="row section">
                <div class="col-md-8 mx-auto ">
                    <h2>At A Glance</h2>
                </div>
            </div>
            <div class="row section">
                <div class="col-md-8 mx-auto ">
                <h2>Body Mass Index (BMI)</h2>
                <p>
                    At your current weight of <b><?php echo $_GET["weight"]; ?> lbs</b> you have a BMI of <b><?php echo get_bmi_from_query(); ?></b>.
                    Your weight is considered <b><?php echo get_bmi_classification(get_bmi_from_query()); ?></b>.
                </p>
                <p>
                    <a target="_blank" href="https://en.wikipedia.org/wiki/Body_mass_index">Body Mass Index</a>
                    serves as a general rule of thumb for categorizing people into broad, weight-based categories. 
                    The categories are as follows:
                </p>

                <table>
                    <tr>
                        <th>Category</th>
                        <th>Range</th>
                    </tr>
                    <tr>
                        <td>Underweight</td>
                        <td>BMI is less than 18.5</td>
                    </tr>
                    <tr>
                        <td>Normal/Healthy</td>
                        <td>BMI is between 18.5 and 25.0</td>
                    </tr>
                    <tr>
                        <td>Overweight</td>
                        <td>BMI is between 25.0 and 30.0</td>
                    </tr>
                    <tr>
                        <td>Obese</td>
                        <td>BMI is greater than 30.0</td>
                    </tr>
                </table>

                <p>
                    By knowing your BMI, you can understand whether or not your body weight is considered healthy. 
                    Additionally, you can know when you need to take action to either lose, maintain, or gain weight.
                </p>
                </div>
            </div>

            <div class="row section">
                <div class="col-md-8 mx-auto ">
                    <h2>Basal Metabolic Rate</h2>
                </div>
            </div>

            <div class="row section">
                <div class="col-md-8 mx-auto ">
                    <h2>Total Daily Energy Expenditure</h2>
                </div>
            </div>

            <div class="row section">
                <div class="col-md-8 mx-auto ">
                    <h2>Projections</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Link to JQuery. Needed for Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
        crossorigin="anonymous"></script>

</body>