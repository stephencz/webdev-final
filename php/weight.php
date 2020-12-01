<?php
/*
 * Created by Stephen Czekalski 
 * November 30, 2020
 */

    /**
     * Converts a length in inches into meters.
     * @param inches A length in inches.
     * @return meters A length in meters.
     */
    function inches_to_meters($inches) {
        return $inches / 39.37;
    }

    /**
     * Converts a length in inches to centimeters.
     * @param inches A length in inches.
     * @return centimeters A length in centimeters.
     */
    function inches_to_centimeters($inches) {
        return $inches * 2.54;
    }

    /**
     * Converts a weight in lbs to kilograms.
     * @param lbs A weight in lbs.
     * @return kilograms A weight in kilograms.
     */
    function lbs_to_kg($lbs) {
        return $lbs / 2.205;
    }

    /**
     * Converts a weight in kilograms to lbs.
     * @param kg A weight in kilograms.
     * @return lbs A weight in lbs.
     */
    function kg_to_lbs($kg) {
        return $kg * 2.205;
    }

    /**
     * Calculates and returns the user's BMI (Body Mass Index).
     * Note: Takes lbs and inches and converts internally for formula.
     *       Formula from CDC website.
     * @param weight The user's weight in lbs.
     * @param height The user's height in inches.
     * @return bmi The user's body mass index.
     */
    function get_bmi($weight, $height) {
        $kg = lbs_to_kg($weight);
        $meters = inches_to_meters($height);

        return round(($kg)/($meters * $meters), 1);
    }

    /**
     * Calulates the user's BMI using parameters from the query string.
     * Note: See get_bmi(...)
     * @return bmi The user's body mass index.
     */
    function get_bmi_from_query() {
        return get_bmi($_GET["weight"], $_GET["height"]);
    }

    /**
     * Given a BMI and height, calculates the corresponding weight.
     * @param bmi The weight of the user in lbs.
     * @param height The height of the user in lbs.
     * @return lbs The weight at the given BMI for the given height class.
     */
    function get_weight_at_bmi($bmi, $height) {
        $meters = inches_to_meters($height);
        return round(kg_to_lbs($bmi * pow($meters, 2)), 0);
    }

    /**
     * Calculates the expected weight of the user given a BMI.
     * @return lbs The weight at a given BMI for a given height class.
     */
    function get_weight_at_bmi_from_query($bmi) {
        return get_weight_at_bmi($bmi, $_GET["height"]);
    }

    /**
     * Calculates and returns the user's BMR (Basal Metabolix Rate).
     * Note: Takes lbs and inches and converts interally for formula.
     *       Formula used is the Mifflin-St Jeor Equation.
     * @param age The age of the user.
     * @param sex The sex of the user.
     * @param weight The weight of the user in lbs.
     * @param height The height of the user in inches.
     */
    function get_bmr($age, $sex, $weight, $height) {
        $kg = lbs_to_kg($weight);
        $centi = inches_to_centimeters($height);

        if(strcmp($sex, "male")) {
            return floor(((10 * $kg) + (6.25 * $centi)) - ((5 * $age) + 5));
        } else {
            return floor(((10 * $kg) + (6.25 * $centi)) - ((5 * $age) - 161));
        }
    }

    /**
     * Calculates the user's BMR using parameters from the query string.
     * Note: See get_bmr(...)
     * @return bmr The user's basal metabolic rate.
     */
    function get_bmr_from_query() {
        return get_bmr($_GET["age"], $_GET["sex"], $_GET["weight"], $_GET["height"]);
    }

    /**
     * Calaultes and returns the user's TDEE.
     * @param age The age of the user.
     * @param sex The sex of the user.
     * @param weight The weight of the user in lbs.
     * @param height The height of the user in inches.
     * @param mode The version of TDEE formula to use.
     * 
     * Modes:
     *  1 - Sedentary (BMR * 1.2)
     *  2 - Light (Exercise 1-3 days/week) (BMR * 1.375)
     *  3 - Moderate (Exercise 3-5 days/week) (BMR * 1.55)
     *  4 - Heavy (Exercise 6-7 days/week) (BMR * 1.725)
     *  5 - Very Heavy (Exercise twice a day) (BMR * 1.9)
     * 
     * @return tdee Total Daily Energy Expenditure.
     */
    function get_tdee($age, $sex, $weight, $height, $mode) {
        $bmr = get_bmr($age, $sex, $weight, $height);
        switch($mode) {
            case 1: return floor($bmr * 1.2); break;
            case 2: return floor($bmr * 1.375); break;
            case 3: return floor($bmr * 1.55); break;
            case 4: return floor($bmr * 1.725); break;
            case 5: return floor($bmr * 1.9); break;
            default: return $bmr;
        }
    }

    /**
     * Calculates the user's TDEE using parameters from the query string
     * and the passed in mode.
     * @return tdee The user's total daily energy expenditure
     */
    function get_tdee_from_query($mode) {
        return get_tdee($_GET["age"], $_GET["sex"], $_GET["weight"], $_GET["height"], $mode);
    }

    /**
     * Takes a BMI and returns a string containing one of the following 
     * classifications:
     * 
     *  - underweight (BMI < 18.5)
     *  - normal (BMI 18.5 - 24.9)
     *  - overweight (BMI 25.0 - 29.9)
     *  - obese (BMI > 30.0)
     * 
     * @param classification A string representing the BMI's classification.
     */
    function get_bmi_classification($bmi) {
        if($bmi < 18.5) {
            return "underweight";

        } elseif($bmi > 18.5 && $bmi < 24.9) {
            return "normal/healthy";

        } else if($bmi > 25.0 && $bmi < 29.9) {
            return "overweight";

        } else {
            return "obese";

        }
    }

?>