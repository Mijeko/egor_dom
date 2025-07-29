import type PhoneDto from "@/dto/PhoneDto.ts";
import type BxImageDto from "@/dto/bitrix/BxImage.ts";
import type EmailDto from "@/dto/EmailDto.ts";

export default interface ManagerDto {
  id: number;
  name?: string;
  secondName?: string;
  lastName?: string;
  phoneList?: PhoneDto[],
  emailList?: EmailDto[],
  avatar?: BxImageDto
}
