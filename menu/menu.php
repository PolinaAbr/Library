<div id="menu" class="menu main-menu">
    <a href="index.php" class="section" id="home">
        �������
    </a>
    <?php
    if ($page == "books")
    {
        echo "<a href='books.php' class='section active'>�����</a>";
    }
    else
    {
        echo "<a href='books.php' class='section'>�����</a>";
    }
    if ($page == "genres")
    {
        echo "<a href='genres.php' class='section active'>�����</a>";
    }
    else
    {
        echo "<a href='genres.php' class='section'>�����</a>";
    }
    if ($page == "authors")
    {
        echo "<a href='authors.php' class='section active'>������</a>";
    }
    else
    {
        echo "<a href='authors.php' class='section'>������</a>";
    }
    ?>
</div>
