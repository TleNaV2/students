<template>
  <div class="add-student">
    <div class="container py-5">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-primary">
              <i class="fas fa-user-plus me-3"></i>Add New Student
            </h1>
            <p class="lead text-muted">เพิ่มข้อมูลนักศึกษาใหม่เข้าไปในระบบ</p>
          </div>

          <div class="form-card card shadow-lg border-0">
            <div class="card-body p-5">
              <form @submit.prevent="addStudent">
                <div class="row g-4">
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input v-model="studentForm.student_id" type="number" class="form-control" id="studentId" placeholder="รหัสนักศึกษา" required>
                      <label for="studentId">
                        <i class="fas fa-id-card me-2"></i>รหัสนักศึกษา
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input v-model="studentForm.first_name" type="text" class="form-control" id="firstName" placeholder="ชื่อ" required>
                      <label for="firstName">
                        <i class="fas fa-user me-2"></i>ชื่อ
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input v-model="studentForm.last_name" type="text" class="form-control" id="lastName" placeholder="นามสกุล" required>
                      <label for="lastName">
                        <i class="fas fa-user me-2"></i>นามสกุล
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input v-model="studentForm.phone" type="tel" class="form-control" id="phone" placeholder="เบอร์โทร">
                      <label for="phone">
                        <i class="fas fa-phone me-2"></i>เบอร์โทร
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <input v-model="studentForm.email" type="email" class="form-control" id="email" placeholder="อีเมล">
                      <label for="email">
                        <i class="fas fa-envelope me-2"></i>อีเมล
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating">
                      <select v-model="studentForm.faculty" class="form-control" id="faculty" required>
                        <option value="">เลือกคณะ</option>
                        <option value="วิทยาศาสตร์">วิทยาศาสตร์</option>
                        <option value="วิศวกรรมศาสตร์">วิศวกรรมศาสตร์</option>
                        <option value="บริหารธุรกิจ">บริหารธุรกิจ</option>
                        <option value="เทคโนโลยีสารสนเทศ">เทคโนโลยีสารสนเทศ</option>
                        <option value="ครุศาสตร์">ครุศาสตร์</option>
                        <option value="มนุษยศาสตร์">มนุษยศาสตร์</option>
                        <option value="นิติศาสตร์">นิติศาสตร์</option>
                        <option value="แพทยศาสตร์">แพทยศาสตร์</option>
                      </select>
                      <label for="faculty">
                        <i class="fas fa-university me-2"></i>คณะ
                      </label>
                    </div>
                  </div>
                  <div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5" :disabled="adding">
                      <i class="fas fa-save me-2"></i>
                      {{ adding ? 'กำลังเพิ่ม...' : 'เพิ่มนักศึกษา' }}
                    </button>
                    <router-link to="/show_student" class="btn btn-outline-secondary btn-lg px-5 ms-3">
                      <i class="fas fa-list me-2"></i>ดูรายชื่อนักศึกษา
                    </router-link>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="text-center mt-5">
            <router-link to="/" class="btn btn-outline-primary">
              <i class="fas fa-home me-2"></i>กลับหน้าหลัก
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useStudentAPI } from '../composables/useStudentAPI'

const router = useRouter()
const { loading: adding, error, addStudent: apiAddStudent } = useStudentAPI()

const studentForm = ref({
  student_id: '',
  first_name: '',
  last_name: '',
  phone: '',
  email: '',
  faculty: ''
})

const addStudent = async () => {
  if (!studentForm.value.student_id || !studentForm.value.first_name || !studentForm.value.last_name) {
    alert('กรุณากรอกข้อมูลที่จำเป็น (รหัสนักศึกษา, ชื่อ, นามสกุล)')
    return
  }

  try {
    const result = await apiAddStudent(studentForm.value)
    if (result.success) {
      alert('เพิ่มข้อมูลนักศึกษาสำเร็จ!')
      // Reset form
      studentForm.value = {
        student_id: '',
        first_name: '',
        last_name: '',
        phone: '',
        email: '',
        faculty: ''
      }
      // Optional: redirect to show students
      // router.push('/show_student')
    } else {
      alert('เพิ่มข้อมูลนักศึกษาไม่สำเร็จ: ' + result.error)
    }
  } catch (err) {
    alert('เพิ่มข้อมูลนักศึกษาไม่สำเร็จ ตรวจสอบการเชื่อมต่อ API')
  }
}
</script>

<style scoped>
.add-student {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  min-height: 100vh;
  padding: 2rem 0;
  position: relative;
}

.add-student::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="form-bg" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="75" cy="75" r="0.5" fill="rgba(255,255,255,0.05)"/><circle cx="50" cy="10" r="0.8" fill="rgba(255,255,255,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23form-bg)"/></svg>');
  animation: float 20s infinite linear;
}

.form-card {
  border-radius: 25px;
  backdrop-filter: blur(20px);
  background: rgba(255, 255, 255, 0.95);
  border: 1px solid rgba(255, 255, 255, 0.2);
  position: relative;
  overflow: hidden;
}

.form-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
}

.form-floating {
  position: relative;
}

.form-floating > .form-control {
  height: calc(3.5rem + 2px);
  padding: 1rem 0.75rem;
  border-radius: 15px;
  border: 2px solid rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  background: rgba(255, 255, 255, 0.9);
}

.form-floating > .form-control:focus {
  border-color: #667eea;
  box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
  background: white;
}

.form-floating > .form-control:hover {
  border-color: rgba(102, 126, 234, 0.5);
}

.form-floating > label {
  padding: 1rem 0.75rem;
  font-weight: 500;
  color: #6c757d;
  transition: all 0.3s ease;
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label {
  opacity: 0.65;
  transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
  color: #667eea;
}

.btn {
  border-radius: 15px;
  padding: 0.875rem 2rem;
  font-weight: 600;
  font-size: 1.1rem;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
  transition: left 0.5s;
}

.btn:hover::before {
  left: 100%;
}

.btn-primary {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border: none;
}

.btn-primary:hover {
  background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
}

.btn-outline-secondary:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(108, 117, 125, 0.2);
}

/* Custom select styling */
select.form-control {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
  background-position: right 0.75rem center;
  background-repeat: no-repeat;
  background-size: 1.5em 1.5em;
  padding-right: 3rem;
}

select.form-control:focus {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23667eea' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
}

/* Animations */
@keyframes float {
  0% { transform: translate(0, 0); }
  10% { transform: translate(-5%, -10%); }
  20% { transform: translate(-15%, 5%); }
  30% { transform: translate(7%, -25%); }
  40% { transform: translate(-5%, 25%); }
  50% { transform: translate(-15%, 10%); }
  60% { transform: translate(15%, 0%); }
  70% { transform: translate(0%, 15%); }
  80% { transform: translate(3%, -10%); }
  90% { transform: translate(-10%, 5%); }
  100% { transform: translate(0, 0); }
}

/* Icon animations */
.fas {
  transition: all 0.3s ease;
}

.btn:hover .fas {
  transform: scale(1.1);
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .form-card {
    margin: 0 1rem;
  }

  .card-body {
    padding: 2rem;
  }

  .display-4 {
    font-size: 2.2rem;
  }

  .btn {
    width: 100%;
    margin-bottom: 0.5rem;
  }

  .btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
  }
}

/* Focus states */
.btn:focus {
  box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-control:focus {
  outline: none;
}
</style>