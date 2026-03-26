<script setup>
import { ref, onMounted } from 'vue'
import { useStudentAPI } from '../composables/useStudentAPI'

// ======================== STUDENTS ========================
const { loading: studentLoading, error, fetchStudents, addStudent: apiAddStudent } = useStudentAPI()
const students = ref([])
const adding = ref(false)
const studentForm = ref({
  student_id: '',
  first_name: '',
  last_name: '',
  phone: '',
  email: '',
  faculty: ''
})

// ดึงข้อมูลนักศึกษาจาก API
const loadStudents = async () => {
  try {
    const data = await fetchStudents()
    students.value = data
  } catch (err) {
    console.error('Fetch error:', err)
    alert('ไม่สามารถโหลดข้อมูลนักศึกษาได้ กรุณาตรวจสอบการเชื่อมต่อ API')
  }
}

const addStudent = async () => {
  if (!studentForm.value.student_id || !studentForm.value.first_name || !studentForm.value.last_name) {
    alert('กรุณากรอกข้อมูลที่จำเป็น (รหัสนักศึกษา, ชื่อ, นามสกุล)')
    return
  }

  adding.value = true
  try {
    const result = await apiAddStudent(studentForm.value)
    if (result.success) {
      alert('เพิ่มข้อมูลนักศึกษาสำเร็จ!')
      loadStudents() // โหลดตารางใหม่
      studentForm.value = {
        student_id: '',
        first_name: '',
        last_name: '',
        phone: '',
        email: '',
        faculty: ''
      }
    } else {
      alert('เพิ่มข้อมูลนักศึกษาไม่สำเร็จ: ' + result.error)
    }
  } catch (err) {
    alert('เพิ่มข้อมูลนักศึกษาไม่สำเร็จ ตรวจสอบการเชื่อมต่อ API')
  } finally {
    adding.value = false
  }
}

onMounted(loadStudents)
</script>

<template>
  <div class="container mt-5">
    <h2 class="fw-bold mb-4">Student Management</h2>

    <div class="card p-4 mb-4 shadow-sm">
      <h5 class="mb-3">Add Student</h5>
      <div class="row g-3">
        <div class="col-md-2">
          <input v-model="studentForm.student_id" class="form-control" placeholder="รหัสนักศึกษา" type="number">
        </div>
        <div class="col-md-2">
          <input v-model="studentForm.first_name" class="form-control" placeholder="ชื่อ">
        </div>
        <div class="col-md-2">
          <input v-model="studentForm.last_name" class="form-control" placeholder="นามสกุล">
        </div>
        <div class="col-md-2">
          <input v-model="studentForm.phone" class="form-control" placeholder="เบอร์โทร">
        </div>
        <div class="col-md-2">
          <input v-model="studentForm.email" class="form-control" placeholder="อีเมล">
        </div>
        <div class="col-md-2">
          <input v-model="studentForm.faculty" class="form-control" placeholder="คณะ">
        </div>
        <div class="col-md-12 text-end">
          <button class="btn btn-success" @click="addStudent" :disabled="adding">
            <i class="fas fa-plus"></i> {{ adding ? 'กำลังเพิ่ม...' : 'เพิ่มนักศึกษา' }}
          </button>
        </div>
      </div>
    </div>

    <div v-if="studentLoading" class="text-center my-5">
      <div class="spinner-border text-primary"></div>
    </div>

    <div v-else-if="students.length === 0" class="text-center my-5">
      <div class="alert alert-warning">
        <h5>ไม่พบข้อมูลนักศึกษา</h5>
        <p>ไม่สามารถโหลดข้อมูลนักศึกษาได้ กรุณาตรวจสอบการเชื่อมต่อฐานข้อมูล</p>
      </div>
    </div>

    <div v-else class="table-responsive">
      <table class="table table-hover table-bordered shadow-sm">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>รหัสนักศึกษา</th>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>เบอร์โทร</th>
            <th>อีเมล</th>
            <th>คณะ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(student, index) in students" :key="student.student_id">
            <td>{{ index + 1 }}</td>
            <td>{{ student.student_id }}</td>
            <td>{{ student.first_name }}</td> 
            <td>{{ student.last_name }}</td>
            <td>{{ student.phone }}</td>
            <td>{{ student.email }}</td>
            <td>{{ student.faculty }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>