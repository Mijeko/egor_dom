import type BxImage from "@/dto/bitrix/BxImage.ts";

import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";

export default interface DeveloperDto {
  id: number;
  name: string;
  description?: string;
  picture?: BxImage,
  buildObjects: BuildObjectDto[]
}
