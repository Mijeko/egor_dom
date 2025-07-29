import type ManagerDto from "@/dto/entity/ManagerDto.ts";

export default interface BxUserDto {
  id: number;
  phone?: string;
  email?: string;
  avatar?: string;
  name?: string;
  lastName?: string;
  secondName?: string;
  fullName?: string;
  bik?: string,
  kpp?: string,
  inn?: string,
  ogrn?: string,
  currAccount?: string,
  corrAccount?: string,
  legalAddress?: string,
  postAddress?: string,
  bankName?: string,
  manager?: ManagerDto,
  type?: 'manager' | 'agent' | 'student'
}
