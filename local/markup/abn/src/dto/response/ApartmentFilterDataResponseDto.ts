import type {ComponentControllerApiResponseDto} from "@/dto/response/ComponentControllerApiResponseDto.ts";
import type {ApartmentFilterProp} from "@/dto/ApartmentFilterData.ts";

export default interface ApartmentFilterDataResponseDto extends ComponentControllerApiResponseDto {
  data: {
    filter: {
      props: ApartmentFilterProp[]
    }
  }
}
