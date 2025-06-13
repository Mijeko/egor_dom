import BxImage from "@/dto/bitrix/BxImage";

export default interface ObjectProduct {
  id: number;
  name: string;
  image: BxImage;
  gallery: BxImage[];
}
