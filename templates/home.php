<html>

<head><link rel="stylesheet" href="style.css"></head>

<body>
    <?php include 'header.php';?>
    <!-- ส่วนแสดงผลหลักของหน้า -->
    <main>
        <div class="container">
            <h1 class="text"><?= htmlspecialchars($title ?? 'Welcome') ?></h1>
            
            <?php if (isset($name) && $name): ?>
                <h2><?= htmlspecialchars('Hello, ' .$name['first'] . ' ' . $name['last']) ?></h2>
            <?php else: ?>
                <h2>Welcome, Guest</h2>
            <?php endif; ?>
        </div>
    </main>
    <!-- ส่วนแสดงผลหลักของหน้า -->
    <?php include 'footer.php' ?>
</body>

</html>