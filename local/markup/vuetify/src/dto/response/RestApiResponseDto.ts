export default interface RestApiResponseDto {
  result: ResultBody
}


interface ResultBody {
  success: boolean,
  error?: string
}
