export interface ComponentControllerApiResponseDto {
  status: 'success' | 'failure';
  data?: any;
}

export interface ComponentControllerApiErrorDto {
  status: string;
  data: ApiErrorData;
}


interface ApiErrorData {
  ajaxRejectData: {
    error: {
      code: number;
      message: string;
      errors: []
    }
  }
}
