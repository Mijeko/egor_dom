import ObjectMap from "@/core/ObjectMap.ts";

declare var BX: any;


export default class ControllerApi {
  static post(componentName: string, data: Object | FormData | null = null) {

    if (data && data !== FormData) {
      data = ObjectMap.objectToFormData(data);
    }

    let formData: FormData = data as FormData;

    let requestParams: ComponentAjaxParamsDto = {
      mode: 'class',
      sessid: BX.bitrix_sessid(),
      method: 'POST',
    };

    if (formData) {
      requestParams.data = formData;
    }

    return BX.ajax.runComponentAction(
      componentName,
      'execute',
      requestParams
    );
  }
}

interface ComponentAjaxParamsDto {
  data?: FormData,
  method: 'POST' | 'GET',
  mode: string,
  sessid: string,
}

