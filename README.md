# ระบบจัดการอีเวนต์ / Event Management System

**PHP 8.2 | MVC Architecture | MySQL / TiDB | Cloudinary | Docker**

---

## 1. ภาพรวมของโปรเจกต์ / Project Overview

โปรเจกต์นี้คือระบบจัดการอีเวนต์ที่พัฒนาขึ้นด้วยสถาปัตยกรรม Model-View-Controller (MVC) แบบปรับแต่งเอง โดยใช้ภาษา PHP 8.2 (Native) ระบบประกอบด้วยฟังก์ชันหลักสำหรับการลงทะเบียนผู้ใช้ การเข้าสู่ระบบ การจัดการโปรไฟล์ และการเข้าร่วมกิจกรรม นอกจากนี้ตัวระบบยังมีการเชื่อมต่อกับบริการคลาวด์สำหรับการจัดการฐานข้อมูลและการจัดเก็บรูปภาพ

This project is an event management system developed using a custom Model-View-Controller (MVC) architecture with PHP 8.2 (Native). The system comprises core functionalities for user registration, login, profile management, and event participation. The system also integrates with cloud services for database management and image storage.

---

## 2. คุณสมบัติหลัก / Core Features

- **การยืนยันตัวตนผู้ใช้งาน / User Authentication**
  ระบบลงทะเบียน เข้าสู่ระบบ และการจัดการเซสชัน
  Registration, login, and session management

- **การจัดการกิจกรรม / Event Management**
  การดูรายละเอียดของกิจกรรม การกดเข้าร่วมกิจกรรม และการจัดการกิจกรรมของผู้ใช้งานแต่ละคน
  View event details, register for events, and manage individual event participation

- **สถาปัตยกรรม MVC แบบกำหนดเอง / Custom MVC Architecture**
  โครงสร้างที่มีการแยกส่วนการทำงานอย่างชัดเจน พร้อมระบบ Router ที่จัดการการนำทางด้วยตนเอง
  Clear separation of concerns with a self-managed routing system

- **การเชื่อมต่อบริการคลาวด์ / Cloud Service Integration**
  - TiDB (เข้ากันได้กับ MySQL) สำหรับการจัดเก็บข้อมูลเชิงสัมพันธ์ / TiDB (MySQL-compatible) for relational data storage
  - Cloudinary สำหรับการจัดการและการจัดเก็บรูปภาพบนคลาวด์ / Cloudinary for cloud-based image management and storage

- **รองรับ Docker / Docker Support**
  มีการเตรียมการตั้งค่า Docker ที่ประกอบไปด้วยเซิร์ฟเวอร์ Apache และ PHP 8.2 พร้อม Extension ที่จำเป็น และการเปิดใช้งาน URL Rewriting
  Pre-configured Docker setup with Apache, PHP 8.2, required extensions, and URL Rewriting enabled

---

## 3. เทคโนโลยีที่ใช้ / Technology Stack

| ประเภท / Category | รายละเอียด / Details |
|---|---|
| ภาษาโปรแกรม / Language | PHP 8.2 (Native) |
| เว็บเซิร์ฟเวอร์ / Web Server | Apache (with mod_rewrite) |
| ฐานข้อมูล / Database | MySQL / TiDB |
| การจัดเก็บรูปภาพ / Image Storage | Cloudinary API |
| การจัดการคอนเทนเนอร์ / Containerization | Docker & Docker Compose |

---

## 4. โครงสร้างของโปรเจกต์ / Project Structure

| ไดเรกทอรี / Directory | รายละเอียด / Description |
|---|---|
| `/databases/` | ไฟล์ที่เกี่ยวข้องกับการจัดเตรียมและเชื่อมต่อฐานข้อมูล / Files related to database setup and connection |
| `/includes/` | ลอจิกหลักของแอปพลิเคชัน เช่น ระบบ Router ระบบ View และ Helpers ต่างๆ / Core application logic including Router, View system, and Helpers (e.g., OTP handler) |
| `/public/` | ไดเรกทอรีหลัก (Document Root) เก็บไฟล์ `index.php` และ Assets สาธารณะ / Document root containing `index.php` (entry point) and public assets |
| `/routes/` | กำหนดเส้นทาง (Routes) ของแอปพลิเคชัน / Defines application routes for events, user management, and other features |
| `/templates/` | เทมเพลตวิว (View Templates) สำหรับการแสดงผล UI / View Templates for rendering the user interface |

---

## 5. ความต้องการของระบบ / System Requirements

เครื่องของคุณจะต้องมีการติดตั้งระบบพื้นฐานอย่างใดอย่างหนึ่งดังต่อไปนี้
The system requires one of the following environments:

- **Docker และ Docker Compose (แนะนำ) / Docker and Docker Compose (Recommended)**
- **สภาพแวดล้อมในเครื่อง / Local Development Environment**
  - PHP 8.2
  - Apache (เปิดใช้งาน mod_rewrite / with mod_rewrite enabled)
  - MySQL

---

## 6. การติดตั้งและการเรียกใช้งาน / Installation & Usage

### วิธีที่ 1: การใช้งานผ่าน Docker (แนะนำ) / Method 1: Docker (Recommended)

1. ทำการโคลน (Clone) โปรเจกต์นี้ลงในเครื่องของคุณ
   Clone this repository to your local machine

2. สร้างไฟล์ `.env` โดยกำหนดตัวแปรสภาพแวดล้อมให้ครบถ้วน (ดูรายละเอียดที่หัวข้อ "ตัวแปรสภาพแวดล้อม")
   Create a `.env` file and configure all required environment variables (see Environment Variables section)

3. ทำการ Build และเปิดใช้งานคอนเทนเนอร์ด้วยคำสั่ง
   Build and run the container using the following commands:
   ```bash
   docker build -t php-mvc-event .
   docker run -p 8080:80 php-mvc-event
   ```

4. เข้าใช้งานแอปพลิเคชันผ่านเบราว์เซอร์ที่ `http://localhost:8080`
   Access the application via browser at `http://localhost:8080`

### วิธีที่ 2: การตั้งค่าผ่าน Local Environment / Method 2: Local Environment Setup

1. โคลนโปรเจกต์ไว้ในไดเรกทอรีของเซิร์ฟเวอร์ (เช่น `htdocs` หรือ `www`)
   Clone the project into your server directory (e.g., `htdocs` or `www`)

2. กำหนดค่า Apache Virtual Host โดยตั้ง Document Root ชี้ไปที่ไดเรกทอรี `/public`
   Configure Apache Virtual Host with Document Root pointing to the `/public` directory

3. ตรวจสอบว่าได้เปิดใช้งาน `mod_rewrite` และอนุญาตให้ใช้งานไฟล์ `.htaccess` (กำหนด `AllowOverride All`)
   Ensure `mod_rewrite` is enabled and `.htaccess` is permitted (`AllowOverride All`)

4. สร้างไฟล์ `.env` พร้อมระบุข้อมูลเชื่อมต่อฐานข้อมูลและข้อมูลยืนยันรับส่ง Cloudinary
   Create a `.env` file with database connection details and Cloudinary credentials

5. เริ่มต้น Apache และเข้าถึงแอปพลิเคชันผ่านโดเมนที่กำหนดใน Virtual Host
   Start Apache and access the application via the configured Virtual Host domain

---

## 7. ตัวแปรสภาพแวดล้อม / Environment Variables

สร้างไฟล์ `.env` ในโฟลเดอร์หลักของโปรเจกต์ โดยกำหนดค่าตัวแปรดังต่อไปนี้
Create a `.env` file in the project root directory with the following variables:

| ตัวแปร / Variable | คำอธิบาย / Description |
|---|---|
| `DB_HOST` | ข้อมูล host ของฐานข้อมูล / Database host address |
| `DB_PORT` | ข้อมูล port ของฐานข้อมูล / Database port number |
| `DB_USERNAME` | ชื่อผู้ใช้งานฐานข้อมูล / Database username |
| `DB_PASSWORD` | รหัสผ่านฐานข้อมูล / Database password |
| `DB_DATABASE` | ชื่อฐานข้อมูล / Database name |
| `IMAGE_CLOUD_URL` | URL ของ Cloudinary / Cloudinary base URL |
| `CLOUDINARY_CLOUD_NAME` | ชื่อ Cloud ของ Cloudinary / Cloudinary cloud name |
| `CLOUDINARY_API_KEY` | คีย์ API ของ Cloudinary / Cloudinary API key |
| `CLOUDINARY_API_SECRET` | ความลับ API ของ Cloudinary / Cloudinary API secret |

```ini
DB_HOST=ข้อมูล_host_ของฐานข้อมูล
DB_PORT=ข้อมูล_port_ของฐานข้อมูล
DB_USERNAME=ชื่อผู้ใช้งานฐานข้อมูล
DB_PASSWORD=รหัสผ่านฐานข้อมูล
DB_DATABASE=ชื่อฐานข้อมูล

IMAGE_CLOUD_URL=url_ของ_cloudinary
CLOUDINARY_CLOUD_NAME=ชื่อ_cloud_ของ_cloudinary
CLOUDINARY_API_KEY=คีย์_api_ของ_cloudinary
CLOUDINARY_API_SECRET=ความลับ_api_ของ_cloudinary
```

---

## 8. การรักษาความปลอดภัย / Security Measures

- ระบบป้องกันการเข้าดูโครงสร้างไฟล์และไดเรกทอรี (Directory Indexing disabled)
  Directory indexing is disabled to prevent unauthorized browsing of the file structure

- ไฟล์ `.env` ถูกป้องกันการเข้าถึงจากภายนอกผ่านการตั้งค่าของ Apache
  The `.env` file is protected from external access via Apache configuration

- ไฟล์ `public/index.php` ตรวจจับและปฏิเสธการเข้าถึง Route ที่ไม่ได้รับอนุญาต โดยเปลี่ยนเส้นทางผู้ใช้ไปยังจุดที่ถูกต้องอย่างเหมาะสม
  `public/index.php` detects and rejects unauthorized route access, redirecting users to the appropriate endpoint

---

## 9. ตารางความต้องการของระบบ / System Requirements Specification

ตารางต่อไปนี้แสดงรายละเอียดความต้องการของระบบพร้อมผู้รับผิดชอบในการพัฒนาแต่ละส่วน
The following table outlines the detailed system requirements together with the assigned developer responsible for each component.

| ลำดับ / No. | ความต้องการของระบบ / System Requirement | ผู้รับผิดชอบ / Responsible |
|---|---|---|
| **ผู้ใช้ทั่วไป / General Users** | | |
| 1.1 | บุคคลทั่วไปต้องสมัครเข้าเป็นสมาชิก (ผู้ใช้) ของระบบได้ / General users must be able to register as members (users) of the system | นิธิกร เกณฑ์พิมาย |
| 1.2 | สมาชิกของระบบ เข้าสู่ระบบโดย อีเมล และ รหัสผ่านได้ / System members must be able to log in using their email address and password | นิธิกร เกณฑ์พิมาย |
| **ผู้สร้างกิจกรรม / Event Organizers** | | |
| 2.1 | สามารถสร้าง/ลบ/แก้ไข กิจกรรมได้มากกว่า 1 กิจกรรม โดยมีรายละเอียดกิจกรรมขั้นต่ำที่ประกอบด้วย ข้อความ ตัวเลข วันที่ และรูปภาพ (1 กิจกรรมมีได้มากกว่า 1 ภาพ) / Must be able to create, delete, and edit more than one event, with minimum event details including text, numbers, date, and images (each event may have more than one image) | วัชริศ เจริญชัย |
| 2.2 | ดูรายชื่อและข้อมูลของคนที่ลงทะเบียนขอเข้าร่วมกิจกรรมได้ / Must be able to view the list and details of members who have registered to join an event | วัชริศ เจริญชัย |
| 2.3 | อนุมัติ/ปฏิเสธคนที่ลงทะเบียนขอเข้าร่วมกิจกรรมได้ / Must be able to approve or reject members who have registered to join an event | วัชริศ เจริญชัย |
| 2.4 | ดูข้อมูลคนที่ขอเข้าร่วมและคนที่เข้าร่วมกิจกรรมแต่ละคนได้ / Must be able to view individual information of both registered applicants and confirmed attendees for each event | วัชริศ เจริญชัย |
| 2.5 | เช็คชื่อการมาเข้าร่วมกิจกรรมของสมาชิกได้ โดยผู้เข้าร่วมกิจกรรมต้องแสดงรหัส OTP (One Time Password) เพื่อเข้างานจากเว็บ บนโทรศัพท์มือถือของผู้เข้าร่วมกิจกรรม / Must be able to check event attendance of members. Attendees are required to present a One-Time Password (OTP) generated via the web on their mobile device at the event venue | ณฐพัฒน์ ตราจันทร์ |
| 2.6 | รหัส OTP ต้องมีเวลาจำกัด เช่น 30 นาที เมื่อหมดเวลา จะต้องมีการสร้าง OTP ใหม่ และ OTP เดิมต้องใช้ไม่ได้ (ผู้จัดไม่ได้เป็นคนสร้าง OTP เอง ระบบจะเป็นสร้าง OTP ให้อัตโนมัติ) / The OTP must have a limited validity period (e.g., 30 minutes). Upon expiry, a new OTP must be automatically generated by the system, and the previous OTP must be invalidated. The organizer does not manually create the OTP | ณฐพัฒน์ ตราจันทร์ |
| 2.7 | ผู้จัดต้องมีกระบวนการตรวจสอบว่า OTP ที่ผู้เข้าร่วมกิจกรรมแสดงนั้น (ที่หน้างาน) ถูกต้องตรงกับในระบบหรือไม่ ถ้าตรงจะเข้าร่วมงานได้ / The organizer must have a verification process to validate the OTP presented by the attendee at the event venue against the system record. Access is granted only upon successful verification | ณฐพัฒน์ ตราจันทร์ |
| **ผู้เข้าร่วมกิจกรรม / Event Attendees** | | |
| 3.1 | ค้นหารายการกิจกรรมที่มีในระบบได้ จาก ชื่อ และ ช่วงวัน (มีวันเริ่มต้น - วันสิ้นสุด) / Must be able to search for events available in the system by name and date range (start date to end date) | ตรีทเศศ ลดจันทร์ |
| 3.2 | ลงทะเบียนขอเข้าร่วมกิจกรรมได้ / Must be able to register to join an event | ตรีทเศศ ลดจันทร์ |
| 3.3 | แสดงรายการกิจกรรมที่ตนเองขอเข้าร่วม ได้/เคยเข้าร่วม และถูกปฏิเสธการเข้าร่วมได้ / Must be able to view a list of events the user has applied for, previously attended, and events for which registration was rejected | ตรีทเศศ ลดจันทร์ |
