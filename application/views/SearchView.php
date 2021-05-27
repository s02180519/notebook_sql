<html>
<head>
    <title>Searching...</title>
</head>
<body>

<form method="post" action="/Search">
    <p>Enter search information, please...</p><input type="text" name="SearchInformation">
    <input type="submit" value="Searching">
</form>
<table>
    <?php
    //var_dump($data);
    if ($data != null) {
        print "<p>Возможные варианты:</p>";
        ?>
        <thead>
        <th>Name</th>
        <th>Phone number</th>
        <th>Address</th>
        <th>Email</th>
        </thead>
        <tbody><?php
        foreach ($data as $row) {
            print "<tr><td>" . $row->name . "</td><td>" . $row->tel . "</td><td>" . $row->address. "</td><td>" . $row->email . "</td>";
        }?>
        </tbody>
        <?php
    }
    else
    print "Совпадений не найдено";?>
</table>
<a href="/Main">Return to the main page</a>

</body>
</html>