<?php include 'header.php' ?>

<main class="max-w-md mx-auto my-12 p-8 bg-white rounded-2xl shadow-xl border border-gray-100">
    <header class="mb-8">
        <h1 class="text-2xl font-black text-gray-800 tracking-tight">เปลี่ยนรหัสผ่าน</h1>
        <p class="text-gray-500 mt-1">
            นักเรียน: <span class="font-bold text-blue-600">
                <?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?>
            </span>
        </p>
    </header>

    <form action="/students-chgpwd?id=<?= $id ?>" method="POST">
        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-widest">รหัสผ่านใหม่</label>
            <input type="password" name="password" required 
                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all">
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-widest">ยืนยันรหัสผ่านอีกครั้ง</label>
            <input type="password" name="confirm_password" required 
                   class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all">
        </div>

          <?php if (isset($_GET['error'])): ?>
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm">
            <?php 
                if($_GET['error'] === 'mismatch') echo '❌ รหัสผ่านไม่ตรงกัน กรุณาลองใหม่';
                if($_GET['error'] === 'update_failed') echo '❌ เกิดข้อผิดพลาดในการบันทึกข้อมูล';
            ?>
        </div>
    <?php endif; ?>


        <div class="pt-4 flex flex-col gap-3">
            <button type="submit" 
                    class="w-full py-3.5 bg-gray-900 hover:bg-black text-white font-bold rounded-xl shadow-lg transition-all active:scale-[0.98]">
                อัปเดตรหัสผ่าน
            </button>
            <a href="/students" class="text-center py-2 text-sm text-gray-400 hover:text-gray-600 transition-colors">
                ย้อนกลับ
            </a>
        </div>
    </form>
</main>

<?php include 'footer.php' ?>