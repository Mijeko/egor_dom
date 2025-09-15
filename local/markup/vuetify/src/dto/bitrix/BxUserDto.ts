import type ManagerDto from "@/dto/entity/ManagerDto.ts";
import type BxImage from "@/dto/bitrix/BxImage.ts";
import type BxUserGroupDto from "@/dto/bitrix/BxUserGroupDto.ts";

export default interface BxUserDto {
  id: number;
  phone?: string;
  email?: string;
  avatar?: BxImage;
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
  position?: BxUserGroupDto
}
