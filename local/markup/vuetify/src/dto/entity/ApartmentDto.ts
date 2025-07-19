import type BxImage from "@/dto/bitrix/BxImage.ts";
import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";

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
  buildObject: BuildObjectDto,
  planImages?: BxImage[]
}
