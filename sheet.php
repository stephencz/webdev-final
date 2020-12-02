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

          <div class="at-a-glance">
            <h2>Your Weight At A Glance</h2>

            <div class="row" style="padding-top: 10px;">
                <div class="col-xl-12">
                    Your Weight: <b><?php echo $_GET["weight"]; ?> lbs</b> <br>
                    Your Height: <b><?php echo $_GET["height"]; ?> inches</b> <br>
                    Healthy/Normal Weight: <b><?php echo get_weight_at_bmi_from_query(18.5) ?> lbs to 
                    <?php echo get_weight_at_bmi_from_query(25.0) ?> lbs </b> <br>
                    Mean Normal Weight: <b><?php echo (get_weight_at_bmi_from_query(18.5) + get_weight_at_bmi_from_query(25.0))/2 ?> lbs</b>
                </div>
            </div>

            <div class="row" style="padding-top: 10px;">
              <div class="col-xl-12">
                <a href="#bmi">BMI</a>:
                <b><?php echo get_bmi_from_query(); ?></b> <br> 
                <a href="#bmi">BMI</a> Category:
                <b><?php echo get_bmi_classification(get_bmi_from_query()); ?></b>
              </div>
            </div>

            <div class="row" style="padding-top: 10px;">
                <div class="col-xl-12">
                    <a href="#bmr">BMR</a> is 
                    <b><?php echo get_bmr_from_query(); ?></b> kcal
                </div>
            </div>

            <div class="row" style="padding-top: 10px;">
              <div class="col-xl-6">
                <a href="#tdee">TDEE</a> @ Sendentary: 
                <b><?php echo get_tdee_from_query(1); ?></b> kcal<br>
                <a href="#tdee">TDEE</a> @ Light Activity:
                <b><?php echo get_tdee_from_query(2); ?></b> kcal<br>
                <a href="#tdee">TDEE</a> @ Moderate Activity:
                <b><?php echo get_tdee_from_query(3); ?></b> kcal
              </div>
              <div class="col-xl-6">
                <a href="#tdee">TDEE</a> @ High Activity:
                <b><?php echo get_tdee_from_query(4); ?></b> kcal<br>
                <a href="#tdee">TDEE</a> @ Very High Activity: 
                <b><?php echo get_tdee_from_query(5); ?></b> kcal
                
              </div>
            </div>

            <?php if ($_GET['losing'] ==  1) { ?> 
            <div class="row" style="padding-top: 25px">
              <div class="col-xl-12">
                <a href="#deficits-and-projections"><b>Calorie Deficits and Weight Loss Projections</b></a>
              </div>
            </div>
            <?php } ?>

          </div>
        </div>
      </div>

      <div class="row section">
        <div class="col-md-8 mx-auto ">
        <h2 id="bmi">Body Mass Index (BMI)</h2>
        <p>
          With a height of <b><?php echo $_GET["height"]; ?> inches</b> and a weight of <b><?php echo $_GET["weight"]; ?> lbs</b>
          you have a BMI of <b><?php echo get_bmi_from_query(); ?></b>.
          At your height a normal/healthy weight is considered to be between <b> <?php echo get_weight_at_bmi_from_query(18.5); ?> lbs</b>
          and <b> <?php echo get_weight_at_bmi_from_query(25.0); ?> lbs</b>.
          Your weight puts you in the <b><?php echo get_bmi_classification(get_bmi_from_query()); ?></b> category.
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
          <h2 id="bmr">Basal Metabolic Rate</h2>
          <p>
              At your weight, you have a BMR of <b><?php echo get_bmr_from_query(); ?></b> kcal.
          </p>
          <p>
              <a href="https://en.wikipedia.org/wiki/Basal_metabolic_rate" target="_blank">Basal Metabolic Rate</a>
              is an approximation of a person's energy expenditure while they are completely at rest. The number provided
              here is an estimate of number of calories you would expend each day if you were to be spend the at rest.
          </p>
          <p>
              Basal Metabolic Rate does not factor in the energy a person would expend through digesting food, regulating 
              their internal temperature, and physically moving. However, it is a good starting place for determining the
              number of calories a person requires everyday.
          </p>
        </div>
      </div>

      <div class="row section">
        <div class="col-md-8 mx-auto ">
          <h2 id="tdee">Total Daily Energy Expenditure</h2>
          <p>
            Total Daily Energy Expenditure is derived from Basal Metabolic Rate, and attempts to represent a person's
            daily energy expenditure at different levels of activity. There are five different activity levels which
            can be used to determine TDEE.
          </p>
            <table>
                <tr>
                    <th>Activity Level</th>
                    <th>Parameters</th>
                    <th>Formula</th>
                </tr>
                <tr>
                    <td>Sedentary</td>
                    <td>Office job/No exercise</td>
                    <td>BMR * 1.2</td>
                </tr>
                <tr>
                    <td>Light Activity</td>
                    <td>Exercise 1 - 3 times a week</td>
                    <td>BMR * 1.375</td>
                </tr>
                <tr>
                    <td>Moderate Activity</td>
                    <td>Exercise 3 - 5 times a week</td>
                    <td>BMR * 1.55</td>
                </tr>
                <tr>
                    <td>High Activity</td>
                    <td>Exercise 6 - 7 times a week</td>
                    <td>BMR * 1.725</td>
                </tr>
                <tr>
                    <td>Very High Activity</td>
                    <td>Exercise two times a day</td>
                    <td>BMR * 1.9</td>
                </tr>
            </table>
          <p>
            Based on your BMR, depending on your level of activity, your TDEE could be:
          </p>
          <table>
            <tr>
                <th>Activity Level</th>
                <th>~Calories Per Day</th>
            </tr>
            <tr>
                <td>Sedentary</td>
                <td><?php echo get_tdee_from_query(1); ?> kcal</td>
            </tr>
            <tr>
                <td>Light Activity</td>
                <td><?php echo get_tdee_from_query(2); ?> kcal</td>
            </tr>
            <tr>
                <td>Moderate Activity</td>
                <td><?php echo get_tdee_from_query(3); ?> kcal</td>
            </tr>
            <tr>
                <td>High Activity</td>
                <td><?php echo get_tdee_from_query(4); ?> kcal</td>
            </tr>
            <tr>
                <td>Very High Activity</td>
                <td><?php echo get_tdee_from_query(5); ?> kcal</td>
            </tr>
            </table>
            <p>
              <b>Note:</b> For weight loss purposes it is generally better to underestimate the
              number of calories you burn each day than overestimate.
            </p>
        </div>
      </div>

      <?php if ($_GET['losing'] ==  1) { ?>
      <div class="row section">
        <div class="col-md-8 mx-auto ">
          <h2 id="deficits-and-projections" >Calorie Deficits</h2>
          <p>
            To lose weight your body must burn more energy than you eat/drink.
            Depending on your activity level, the number of calories you burn each
            day will be somewhere between your <a href="#bmr">BMR</a> and your highest 
            <a href="#tdee">TDEE</a> value.
          </p>
          <p>
            To lose weight you must burn more calories than you eat or drink. To do
            this you must limit your caloric intake to a <b>deficit</b>. A healthy caloric
            deficit is generaly considered to be between 250 and 1000 calories less than your
            daily energy expenditure. 
          </p>
          <p>
            Here are some possible daily calorie limits based on your Basal Metabolic Rate
            and Total Daily Energy Expenditure at different deficits.
          </p>
          <table>
            <tr>
              <th>Measure</th>
              <th>Base</th>
              <th>-250 kcal</th>
              <th>-500 kcal</th>
              <th>-750 kcal</th>
              <th>-1000 kcal</th>
            </tr>
            <tr>
              <td>Basal Metabolic Rate</td>
              <td><?php echo get_bmr_from_query(); ?></td>
              <td><?php echo get_bmr_from_query() - 250; ?></td>
              <td><?php echo get_bmr_from_query() - 500; ?></td>
              <td><?php echo get_bmr_from_query() - 750; ?></td>
              <td><?php echo get_bmr_from_query() - 1000; ?></td>
            </tr>
            <tr>
              <td>TDEE @ Sendentary</td>
              <td><?php echo get_tdee_from_query(1) ?></td>
              <td><?php echo get_tdee_from_query(1) - 250; ?></td>
              <td><?php echo get_tdee_from_query(1) - 500; ?></td>
              <td><?php echo get_tdee_from_query(1) - 750; ?></td>
              <td><?php echo get_tdee_from_query(1) - 1000; ?></td>
            </tr>
            <tr>
              <td>TDEE @ Light Activity</td>
              <td><?php echo get_tdee_from_query(2) ?></td>
              <td><?php echo get_tdee_from_query(2) - 250; ?></td>
              <td><?php echo get_tdee_from_query(2) - 500; ?></td>
              <td><?php echo get_tdee_from_query(2) - 750; ?></td>
              <td><?php echo get_tdee_from_query(2) - 1000; ?></td>
            </tr>
            <tr>
              <td>TDEE @ Moderate Activity</td>
              <td><?php echo get_tdee_from_query(3) ?></td>
              <td><?php echo get_tdee_from_query(3) - 250; ?></td>
              <td><?php echo get_tdee_from_query(3) - 500; ?></td>
              <td><?php echo get_tdee_from_query(3) - 750; ?></td>
              <td><?php echo get_tdee_from_query(3) - 1000; ?></td>
            </tr>
            <tr>
              <td>TDEE @ High Activity</td>
              <td><?php echo get_tdee_from_query(4) ?></td>
              <td><?php echo get_tdee_from_query(4) - 250; ?></td>
              <td><?php echo get_tdee_from_query(4) - 500; ?></td>
              <td><?php echo get_tdee_from_query(4) - 750; ?></td>
              <td><?php echo get_tdee_from_query(4) - 1000; ?></td>
            </tr>
            <tr>
              <td>TDEE @ Very High Activity</td>
              <td><?php echo get_tdee_from_query(5) ?></td>
              <td><?php echo get_tdee_from_query(5) - 250; ?></td>
              <td><?php echo get_tdee_from_query(5) - 500; ?></td>
              <td><?php echo get_tdee_from_query(5) - 750; ?></td>
              <td><?php echo get_tdee_from_query(5) - 1000; ?></td>
            </tr>
          </table>

          <p>
            <b>WARNING: </b> Consuming too few calories for long periods of time can have dangerous side effects.
            Some of the above deficits may be dangerous if used. Always use caution when making dramatic changes
            to your diet and consult a doctor if you feel unsure.
          </p>

          <h3 style="margin-top: 3rem;">Weight Loss Projections</h3>
          <p>
            You can use the projection tool to get a better idea of how long it will take you to reach your
            goal weight. Additionally, you can see what kind of adjustments you will have to make to your
            calorie deficit over time.
            To use it:
          </p>

          <ol>
            <li>
              Enter a calorie expenditure such as your <a href="#bmr">BMR</a> or one of your <a href="#tdee">TDEE</a> values.
              This is the number of calories you burn each day.
            </li>
            <li>
              Then enter a calorie deficit. This number must be less than your calorie expenditure. Check out the 
              <a href="#deficits-and-projections">deficits table</a> for some possible values.
            </li>
            <li>
              Finally, enter a goal weight such is greater than 0, but less than your current weight.
            </li>
          </ol>

          <table class="projection">
            <tr>
              <td>
                <label for="calorie-expenditure">Calorie Expenditure: </label>
                <input type="text" name="calorie-expenditure" id="calorie-expenditure" value="">
              </td>
            </tr>
            <tr>
              <td>
                <label for="calorie-deficit">Calorie Deficit: </label>
                <input type="text" name="calorie-deficit" id="calorie-deficit" value="">
              </td>
            </tr>
            <tr>
              <td>
                <label for="goal-weight">Goal Weight (lbs): </label>
                <input type="text" name="goal-weight" id="goal-weight" value="">
              </td>
            </tr>
            <tr>
              <td>
                <button type="button" onclick="create_projection_chart();">Create/Update Chart</button>
              </td>
            </tr>
          </table>

          <canvas id="weight-chart">
          </canvas>
          <canvas id="expenditure-chart">
          </canvas>
          <canvas id="deficit-chart">
          </canvas>

          <p style="margin-top: 30px;">
            <b>Note:</b> The charts take into account the fact that as a person loses weight, the number of
            calories they will expend decreases. Therefore, as you lose weight, it might become necessary to
            adopt a smaller calorie deficit as your old deficit become unhealthy or unmaintable.
          </p>

        </div>
      </div>
      <?php } ?>

    </div>
  </div>

  <!-- Link to JQuery. Needed for Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
    crossorigin="anonymous"></script>

  <!-- Chart.js for Projection Charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script src="/js/projection.js"></script>

</body>