import type PhoneDto from "@/dto/PhoneDto.ts";

export default interface ManagerDto {
  id: number;
  name: string;
  secondName: string;
  lastName: string;
  phones: PhoneDto[]
}
