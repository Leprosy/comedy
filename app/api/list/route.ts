import { DataItem } from "@/app/types";
import { appData } from "../crappyDb";

export async function GET() {
  return Response.json(
    appData.map((item: DataItem) => {
      return { id: item.id, name: item.name };
    })
  );
}
