import type BuildObjectDto from "@/dto/entity/BuildObjectDto.ts";
import type DeveloperDto from "@/dto/entity/DeveloperDto.ts";

export default interface DeveloperListItemDto {
  developer: DeveloperDto;
  buildObjectsCount?: number,
  buildObjects?: BuildObjectDto[],
}
