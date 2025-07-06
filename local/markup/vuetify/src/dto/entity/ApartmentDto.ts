import type BuildObjectDetailDto from "@/dto/present/BuildObjectDetailDto.ts";

export default interface ApartmentDto {
  id: string;
  buildObjectId: number;
  name: string;
  price: number;
  rooms: number;
  floor: number;
  buildObject: BuildObjectDetailDto
}
