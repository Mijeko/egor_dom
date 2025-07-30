import type {ComponentControllerApiResponseDto} from "@/dto/response/ComponentControllerApiResponseDto.ts";

export default interface RegisterStudentResponseDto extends ComponentControllerApiResponseDto {
  data: {
    redirect: string;
  }
}
