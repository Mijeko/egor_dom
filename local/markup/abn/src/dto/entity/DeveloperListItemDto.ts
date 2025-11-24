import type BxImageDto from "@/dto/bitrix/BxImage.ts";

export default interface DeveloperListItemDto {
  id: number;
  name: string;
  picture?: BxImageDto;
  buildObjectsCount?: number,
  url: {
    detail: string
  };
}
