import type BxImage from "../dto/bitrix/BxImage.ts";


export default interface BuildObjectDetail {
  id: number;
  name: string;
  detailLink: string;
  image: BxImage;
  gallery: BxImage[];
}
