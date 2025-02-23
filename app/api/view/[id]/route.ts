import { NextRequest } from "next/server";
import { appData, DataItem } from "../../list/route";

export async function GET(request: NextRequest, { params }: { params: Promise<{ id: number }> }) {
  const { id } = await params;
  const result = appData.filter((item: DataItem) => item.id == id);
  return Response.json(result.length > 0 ? result[0] : {});
}
