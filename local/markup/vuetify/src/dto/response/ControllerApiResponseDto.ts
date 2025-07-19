export default interface ControllerApiResponseDto {
  status: 'success';
  data?: any;
  error?: ControllerApiErrorDto;
}

interface ControllerApiErrorDto {
  code: number;
  message: string;
  errors: any;
}
