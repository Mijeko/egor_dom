export default interface CommonApiResponseDto {
  result: ResultBody
}


interface ResultBody {
  success: boolean,
  error?: string
}
