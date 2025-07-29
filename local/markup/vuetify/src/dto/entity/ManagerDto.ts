import type PhoneDto from "@/dto/PhoneDto.ts";
import type BxImageDto from "@/dto/bitrix/BxImage.ts";

export default interface ManagerDto {
  id: number;
  name?: string;
  secondName?: string;
  lastName?: string;
  phones?: PhoneDto[],
  avatar?: BxImageDto
}
