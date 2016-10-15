<?php
include "top.php";
$data = array();
$school = "Arlington";
if (!empty($_POST["school"])) {
    $school = htmlentities($_POST["school"], ENT_QUOTES, "UTF-8");
}

if (isset($_POST["btnSubmit2"])) {
    $school = htmlentities($_POST["school"], ENT_QUOTES, "UTF-8");
    $schoolData = array();
    $schoolData[] = $school;
    // start aggressive amount of queries for each year here
    $query = 'SELECT fldSTR, fldDropout, fldEnrollment, fldSpending, fldProficiency, fldIncome, fldTechnology';
    $query.= 'FROM tbl2012';
    $query.= 'WHERE fldSchool = ?';
    $yr2012 = $thisDatabaseReader->select($query, $schoolData, 1, 0, 0, 0, false, false);
    $query = 'SELECT fldSTR, fldDropout, fldEnrollment, fldSpending, fldProficiency, fldIncome, fldTechnology';
    $query.= 'FROM tbl2013';
    $query.= 'WHERE fldSchool = ?';
    $yr2013 = $thisDatabaseReader->select($query, $schoolData, 1, 0, 0, 0, false, false);
    $query = 'SELECT fldSTR, fldDropout, fldEnrollment, fldSpending, fldProficiency, fldIncome, fldTechnology';
    $query.= 'FROM tbl2014';
    $query.= 'WHERE fldSchool = ?';
    $yr2014 = $thisDatabaseReader->select($query, $schoolData, 1, 0, 0, 0, false, false);
    $query = 'SELECT fldSTR, fldDropout, fldEnrollment, fldSpending, fldProficiency, fldIncome, fldTechnology';
    $query.= 'FROM tbl2015';
    $query.= 'WHERE fldSchool = ?';
    $yr2015 = $thisDatabaseReader->select($query, $schoolData, 1, 0, 0, 0, false, false);
    $query = 'SELECT fldSTR, fldDropout, fldEnrollment, fldSpending, fldProficiency, fldIncome, fldTechnology';
    $query.= 'FROM tbl2016';
    $query.= 'WHERE fldSchool = ?';
    $yr2016 = $thisDatabaseReader->select($query, $schoolData, 1, 0, 0, 0, false, false);
    // doin dat math to find averages in sql
    $query = 'SELECT fldSTR, fldDropout, fldEnrollment, fldSpending, fldProficiency, fldIncome, fldTechnology';
    $query.= 'FROM tbl2016';
    $query.= 'WHERE fldSchool = ?';
    $yr2016 = $thisDatabaseReader->select($query, $schoolData, 1, 0, 0, 0, false, false);
    // finding them averages for each column per year
    $query = 'SELECT AVG(fldSTR), AVG(fldDropout), AVG(fldEnrollment), AVG(fldSpending), AVG(fldProficiency), AVG(fldIncome), AVG(fldTechnology)';
    $query.= 'FROM tbl2012';
    $avgyr2012 = $thisDatabaseReader->select($query, $schoolData, 1, 0, 0, 0, false, false);
    $query = 'SELECT AVG(fldSTR), AVG(fldDropout), AVG(fldEnrollment), AVG(fldSpending), AVG(fldProficiency), AVG(fldIncome), AVG(fldTechnology)';
    $query.= 'FROM tbl2013';
    $avgyr2013 = $thisDatabaseReader->select($query, $schoolData, 1, 0, 0, 0, false, false);
    $query = 'SELECT AVG(fldSTR), AVG(fldDropout), AVG(fldEnrollment), AVG(fldSpending), AVG(fldProficiency), AVG(fldIncome), AVG(fldTechnology)';
    $query.= 'FROM tbl2014';
    $avgyr2014 = $thisDatabaseReader->select($query, $schoolData, 1, 0, 0, 0, false, false);
    $query = 'SELECT AVG(fldSTR), AVG(fldDropout), AVG(fldEnrollment), AVG(fldSpending), AVG(fldProficiency), AVG(fldIncome), AVG(fldTechnology)';
    $query.= 'FROM tbl2015';
    $avgyr2015 = $thisDatabaseReader->select($query, $schoolData, 1, 0, 0, 0, false, false);
    $query = 'SELECT AVG(fldSTR), AVG(fldDropout), AVG(fldEnrollment), AVG(fldSpending), AVG(fldProficiency), AVG(fldIncome), AVG(fldTechnology)';
    $query.= 'FROM tbl2016';
    $avgyr2016 = $thisDatabaseReader->select($query, $schoolData, 1, 0, 0, 0, false, false);
    $school = htmlentities($_POST["district"], ENT_QUOTES, "UTF-8");
    ?>
<p>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', "<?php echo $school?>", 'Average'],
                ['2012', <?php foreach($yr2012 as $eachRow){echo $eachRow['fldSpending'];}?>, <?php foreach($avgyr2012 as $eachRow){echo $eachRow['fldSpending'];}?>],
                ['2013', <?php foreach($yr2013 as $eachRow){echo $eachRow['fldSpending'];}?>, <?php foreach($avgyr2013 as $eachRow){echo $eachRow['fldSpending'];}?>],
                ['2014', <?php foreach($yr2014 as $eachRow){echo $eachRow['fldSpending'];}?>, <?php foreach($avgyr2014 as $eachRow){echo $eachRow['fldSpending'];}?>],
                ['2015', <?php foreach($yr2015 as $eachRow){echo $eachRow['fldSpending'];}?>, <?php foreach($avgyr2015 as $eachRow){echo $eachRow['fldSpending'];}?>],
                ['2016', <?php foreach($yr2016 as $eachRow){echo $eachRow['fldSpending'];}?>, <?php foreach($avgyr2016 as $eachRow){echo $eachRow['fldSpending'];}?>],
            ]);

            var options = {
                title: 'School District vs. Average,
                legend: {position: 'bottom'}
        }
        ;

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
    </script>
</p>
    <?php
    foreach($yr2016 as $eachRow){
        $compare1;
        $compare1 = $eachRow['fldPupil'];
    }
    foreach($avgyear2016 as $eachRow){
        $compare2;
        $compare2 = $eachRow['fldPupil'];
    }
} else {
    ?>
    <!-- the form starts with an article tag surrounding it -->
    <article> 
        <!-- form is created -->
        <form action="form.php"
              method="post"
              id="formData">
            <!-- listbox 1 and 2 are created -->
            <fieldset class="listbox">
                <legend>Choose a County</legend>
                <select id="county" name="county" tabindex="500" >
                    <?php
                    // this code uses sql query to pull each distinct department and put it in a listbox, when it is submitted the value is the department string
                    $queryA = 'SELECT pmkId, fldCounty FROM tblCounty';

                    $department = $thisDatabaseReader->select($queryA,"", 0, 0, 0, 0, false, false);
                    
                    if (is_array($department)) {
                        foreach ($department as $eachRow) {
                            print '<option value="' . $eachRow['pmkId'] . '">' . $eachRow['fldCounty'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </fieldset>
            <fieldset class="buttons">
                <legend></legend>
                <input type="submit" id="btnSubmit1" name="btnSubmit1" value="Submit" tabindex="900" class="button">
            </fieldset>
            <fieldset class="listbox">
                <legend>Choose a School System</legend>
                <select id="school" name="school" tabindex="500" >
                    <?php
                    // this code is dependent on whether or not the first button was submitted, if submitted only classes from a certain department appear otherwise all appear
                    if (isset($_POST["btnSubmit1"])) {
                        $countyID = htmlentities($_POST["county"], ENT_QUOTES, "UTF-8");
                        $data[] = $countyID;
                        $query = 'SELECT fldSchool FROM tblCourses WHERE fldID = ? ';
                        $courses = $thisDatabaseReader->select($query, $data, 1, 0, 0, 0, false, false);
                    } else {
                        $query = 'SELECT fldSchool FROM tbl2012';
                        $courses = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
                    }
                    // this shows all the relavent class data from the query above
                    foreach ($courses as $eachRow) {
                        if ($eachRow[0] != "") {
                            print '<option value=' . $eachRow['fldSchool'] . '>' . $eachRow['fldSchool'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </fieldset>
            <fieldset class="buttons">
                <legend></legend>
                <input type="submit" id="btnSubmit2" name="btnSubmit2" value="Submit" tabindex="900" class="button">
            </fieldset>
        </form>
    </article>
    <?php
}
include "footer.php";
?>
</body>
</html>