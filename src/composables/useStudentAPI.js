import { ref } from 'vue'

// API Base URL
const API_BASE = '/api'

// API Service for Student Management
export function useStudentAPI() {
  const loading = ref(false)
  const error = ref(null)

  // ดึงข้อมูลนักศึกษาทั้งหมด
  const fetchStudents = async () => {
    loading.value = true
    error.value = null
    try {
      const response = await fetch(`${API_BASE}/show_student.php`)
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
      }
      const data = await response.json()
      return data
    } catch (err) {
      error.value = err.message
      console.error('Error fetching students:', err)
      throw err
    } finally {
      loading.value = false
    }
  }

  // เพิ่มนักศึกษาใหม่
  const addStudent = async (studentData) => {
    loading.value = true
    error.value = null
    try {
      const response = await fetch(`${API_BASE}/add_student.php`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(studentData)
      })

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
      }

      const result = await response.json()
      return result
    } catch (err) {
      error.value = err.message
      console.error('Error adding student:', err)
      throw err
    } finally {
      loading.value = false
    }
  }

  return {
    loading,
    error,
    fetchStudents,
    addStudent
  }
}