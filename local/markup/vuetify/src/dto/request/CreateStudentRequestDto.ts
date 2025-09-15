export default interface CreateStudentRequestDto {
  managerId: number;
  phone: string;
  email: string;
  name?: string;
  lastName?: string
}
