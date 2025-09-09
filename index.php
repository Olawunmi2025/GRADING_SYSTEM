<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRADING SYSTEM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="container">
    <h2>OGUN STATE MINISTRY OF EDUCATION <br>🎓 Student Grading System 🎓</h2>

    <form method="post">
      <?php 
      // Allow 5 subject entries
      for ($i=1; $i<=5; $i++) {
        echo "<div class='row'>
                <label>Subject $i:</label>
                <select name='subject[]' required>
                  <option value=''>Select Subject</option>
                  <option value='Maths'>Maths</option>
                  <option value='Physics'>Physics</option>
                  <option value='Chemistry'>Chemistry</option>
                  <option value='Biology'>Biology</option>
                  <option value='English'>English</option>
                </select>
                <input type='number' name='score[]' min='0' max='100' placeholder='Enter Score' required>
              </div>";
      }
      ?>
      <button type="submit" name="submit">View Result</button>
    </form>

    <?php
    // Function to assign grade
    function getGrade($score) {
      if ($score >= 70 && $score <= 100) return "A";
      elseif ($score >= 60) return "B";
      elseif ($score >= 50) return "C";
      elseif ($score >= 40) return "D";
      elseif ($score >= 29) return "E";
      else return "F";
    }

    // Display the Final results
    if (isset($_POST["submit"])) {
      echo "<h3 style='margin-top:20px; color:#1f2937;'>Final Results</h3>";
      echo "<table>
              <tr>
                <th>Subject</th>
                <th>Score</th>
                <th>Grade</th>
              </tr>";

      $subjects = $_POST["subject"];
      $scores = $_POST["score"];
      $total = 0; $count = 0;

      for ($i=0; $i<count($subjects); $i++) {
        if (!empty($subjects[$i]) && $scores[$i] !== "") {
          $subject = $subjects[$i];
          $score = $scores[$i];
          $grade = getGrade($score);
          $gradeClass = "grade-$grade";
          $total += $score;
          $count++;
          echo "<tr>
                  <td>$subject</td>
                  <td>$score</td>
                  <td class='$gradeClass'>$grade</td>
                </tr>";
        }
      }

       //Display the Average and the overall grade

      if ($count > 0) {
        $average = $total / $count;
        $overallGrade = getGrade($average);
   
        echo "<tr>
                <td><strong>Average</strong></td>
                <td><strong>".round($average,2)."</strong></td>
                <td class='grade-$overallGrade'><strong>$overallGrade</strong></td>
              </tr>";
      }

      echo "</table>";
    }
    ?>
  </div>
</body>
</html>