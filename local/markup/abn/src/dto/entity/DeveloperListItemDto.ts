import type BxImageDto from "@/dto/bitrix/BxImage.ts";
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";

export default interface DeveloperListItemDto {
  id: number;
  name: string;
  description?: string;
  picture?: BxImageDto;
  buildObjectsCount?: number,
  buildObjects?: BuildObjectDto[],
  detailUrl: string;
}
