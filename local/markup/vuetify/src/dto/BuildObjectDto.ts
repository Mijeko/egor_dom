import type BxImage from "../dto/bitrix/BxImage.ts";

export default interface BuildObjectDto {
  id: number;
  name: string;
  detailLink: string;
  picture?: BxImage;
}
