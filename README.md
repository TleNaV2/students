# Student Management System

ระบบจัดการนักศึกษาที่สร้างด้วย Vue.js 3 และ PHP API

## คุณสมบัติ

- 📚 จัดการข้อมูลนักศึกษา (เพิ่ม, ดู, แก้ไข, ลบ)
- 🎨 อินเทอร์เฟซที่ทันสมัยด้วย Bootstrap 5
- 🔄 API ที่ทำงานได้รวดเร็ว
- 📱 Responsive Design
- ⚡ Vue 3 Composition API

## เทคโนโลยีที่ใช้

- **Frontend**: Vue.js 3, Bootstrap 5, FontAwesome
- **Backend**: PHP 8, PDO, MySQL
- **Build Tool**: Vue CLI

## การติดตั้งและรัน

### 1. ติดตั้ง Dependencies
```bash
npm install
```

### 2. ตั้งค่า Database
- สร้าง database ชื่อ `student_db`
- import ไฟล์ `php_api/students.sql`

### 3. เริ่ม XAMPP
- เปิด Apache และ MySQL ใน XAMPP Control Panel

### 4. รัน Development Server
```bash
npm run serve
```

### 5. เข้าถึงแอปพลิเคชัน
- Frontend: http://localhost:8080
- API Base: http://localhost/project-test/php_api/

## API Endpoints

### ดึงข้อมูลนักศึกษาทั้งหมด
```
GET /api/students.php
```
**Response:**
```json
[
  {
    "student_id": 1,
    "first_name": "สมชาย",
    "last_name": "ใจดี",
    "phone": "0812345678",
    "email": "somchai@mail.com",
    "faculty": "วิทยาศาสตร์"
  }
]
```

### เพิ่มนักศึกษาใหม่
```
POST /api/add_student.php
```
**Request Body:**
```json
{
  "student_id": 1,
  "first_name": "ชื่อ",
  "last_name": "นามสกุล",
  "phone": "เบอร์โทร",
  "email": "อีเมล",
  "faculty": "คณะ"
}
```
**Response:**
```json
{
  "success": "เพิ่มข้อมูลนักศึกษาสำเร็จ"
}
```

## โครงสร้างโปรเจค

```
project-test/
├── public/
│   └── index.html
├── src/
│   ├── components/
│   ├── composables/
│   │   └── useStudentAPI.js
│   ├── router/
│   │   └── index.js
│   ├── store/
│   │   └── index.js
│   ├── views/
│   │   ├── HomeView.vue
│   │   ├── AboutView.vue
│   │   ├── ContactView.vue
│   │   ├── show_student.vue
│   │   └── AddStudentView.vue
│   ├── App.vue
│   └── main.js
├── php_api/
│   ├── add_student.php
│   ├── check_db.php
│   ├── condb.php
│   ├── show_student.php
│   ├── students.php
│   └── students.sql
└── vue.config.js
```

## การพัฒนา

### เพิ่มฟีเจอร์ใหม่
1. สร้าง component ใหม่ใน `src/components/`
2. เพิ่ม route ใน `src/router/index.js`
3. เพิ่ม API endpoint ใน `php_api/`

### การ build สำหรับ production
```bash
npm run build
```

## ปัญหาที่พบบ่อย

### API ไม่ทำงาน
- ตรวจสอบ XAMPP Apache และ MySQL เปิดอยู่
- ตรวจสอบ database และ table มีอยู่จริง
- ตรวจสอบ CORS headers ใน PHP files

### Vue app ไม่โหลด
- ตรวจสอบ `npm install` เสร็จสิ้น
- ตรวจสอบ port 8080 ไม่ถูกใช้งาน

## ผู้พัฒนา

พัฒนาโดย [ชื่อผู้พัฒนา]

## License

MIT License
  {
    "student_id": 1,
    "first_name": "สมชาย",
    "last_name": "ใจดี",
    "phone": "0812345678",
    "email": "somchai@mail.com",
    "faculty": "วิทยาศาสตร์"
  }
]
```

### เพิ่มนักศึกษาใหม่
```
POST /api/add_student.php
```
**Request Body:**
```json
{
  "student_id": 12345,
  "first_name": "ชื่อ",
  "last_name": "นามสกุล",
  "phone": "0812345678",
  "email": "email@example.com",
  "faculty": "คณะ"
}
```

## โครงสร้างโปรเจกต์

```
project-test/
├── public/
│   └── index.html          # HTML template
├── src/
│   ├── composables/
│   │   └── useStudentAPI.js # API composable
│   ├── views/
│   │   ├── HomeView.vue     # หน้าหลัก
│   │   ├── show_student.vue # แสดงรายชื่อนักศึกษา
│   │   ├── AddStudentView.vue # เพิ่มนักศึกษา
│   │   ├── AboutView.vue    # เกี่ยวกับ
│   │   └── ContactView.vue  # ติดต่อ
│   ├── router/
│   │   └── index.js         # Vue Router config
│   └── App.vue              # Root component
├── php_api/
│   ├── condb.php           # Database connection
│   ├── show_student.php    # Get students API
│   ├── add_student.php     # Add student API
│   └── students.sql        # Database schema
└── vue.config.js           # Vue CLI config
```

## การใช้งาน API ใน Vue Components

```javascript
import { useStudentAPI } from '../composables/useStudentAPI'

const { loading, error, fetchStudents, addStudent } = useStudentAPI()

// ดึงข้อมูลนักศึกษา
const students = ref([])
const loadStudents = async () => {
  try {
    const data = await fetchStudents()
    students.value = data
  } catch (err) {
    console.error('Error:', err)
  }
}

// เพิ่มนักศึกษา
const addNewStudent = async (studentData) => {
  try {
    const result = await addStudent(studentData)
    if (result.success) {
      console.log('Student added successfully')
    }
  } catch (err) {
    console.error('Error:', err)
  }
}
```

## สร้าง Production Build

```bash
npm run build
```

ไฟล์ที่ build แล้วจะอยู่ในโฟลเดอร์ `dist/`

## การปรับแต่ง

- **ธีมสี**: แก้ไข CSS variables ใน `src/App.vue`
- **API URL**: แก้ไขใน `src/composables/useStudentAPI.js`
- **Database**: แก้ไขใน `php_api/condb.php`

## License

MIT License
