export default interface CreateAgentRequestDto {
  managerId: number;
  phone: string;
  email: string;
  name?: string;
  lastName?: string
}
