import type BxImage from "@/dto/bitrix/BxImage.ts";

export default interface DeveloperDto {
  id: number;
  name: string;
  picture?: BxImage
}
