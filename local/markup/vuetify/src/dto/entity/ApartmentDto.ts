import type BuildObjectDetailDto from "@/dto/present/BuildObjectDetailDto.ts";
import type BxImage from "@/dto/bitrix/BxImage.ts";

export default interface ApartmentDto {
  id: string;
  buildObjectId: number;
  name: string;
  description?: string;
  price: number;
  rooms: number;
  floor: number;
  renovation?: string;
  builtYear?: number;
  builtState?: string;
  buildObject: BuildObjectDetailDto,
  planImages?: BxImage[]
}
