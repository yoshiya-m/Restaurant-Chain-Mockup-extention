<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Users</title>
</head>
<body>
    <form action="download.php" method="post">
        <div>
            <label for="employee-count">Number of Employees in the restaurant chain:</label>
            <input type="number" id="employee-count" name="employee-count" min="1" max="10" value="5">
        </div>
        <div>
            <label>Salary range for employees:</label><br>
            <label for="salary-min">Minimum:</label><input type="number" id="salary-min" name="salary-min" min="1" max="10" value="1">
            <label for="salary-max">Max:</label><input type="number" id="salary-max" name="salary-max" min="1" max="10" value="10">
        </div>
        <div>
            <label for="location-count">Number of restaurant locations:</label>
            <input type="number" id="location-count" name="location-count" min="1" max="5" value="3">
        </div>
        <div>
            <label>ZIP Code range:</label><br>
            <label for="zipcode-min">Minimum:</label><input type="number" id="zipcode-min" name="zipcode-min" min="1" max="90000" value="1">
            <label for="zipcode-max">Max:</label><input type="number" id="zipcode-max" name="zipcode-max" min="1" max="90000" value="90000">
        </div>
        <div>
            <label for="format">Download Format:</label>
            <select id="format" name="format">
                <option value="html">HTML</option>
                <option value="markdown">Markdown</option>
                <option value="json">JSON</option>
                <option value="txt">Text</option>
            </select>
        </div>





        <button type="submit">Generate</button>

    </form>
    
</body>

</html>