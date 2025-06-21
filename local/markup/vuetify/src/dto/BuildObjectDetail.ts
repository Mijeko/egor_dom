import type BxImage from "../dto/bitrix/BxImage.ts";
import type ApartmentDto from "@/dto/entity/ApartmentDto.ts";


export default interface BuildObjectDetail {
  id: number;
  name: string;
  detailLink: string;
  image: BxImage;
  gallery: BxImage[];
  apartments?: ApartmentDto[]
}
