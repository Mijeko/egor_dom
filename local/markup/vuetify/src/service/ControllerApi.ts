import ObjectMap from "@/core/ObjectMap.ts";

declare var BX: any;


export default class ControllerApi {
  static post(componentName: string, data: Object | FormData) {

    if (data !== FormData) {
      data = ObjectMap.objectToFormData(data);
    }

    let formData: FormData = data as FormData;

    return BX.ajax.runComponentAction(
      componentName,
      'execute',
      {
        mode: 'class',
        data: formData,
        sessid: BX.bitrix_sessid()
      }
    );
  }
}
