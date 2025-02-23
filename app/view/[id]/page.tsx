"use client";
import Slide from "@/app/_components/Slide";
import Title from "@/app/_components/Title";
import { DataItem } from "@/app/api/list/route";
import { useParams } from "next/navigation";
import { useEffect, useState } from "react";

export default function View() {
  const [data, setData] = useState<DataItem>();
  const [slide, setSlide] = useState<number>(0);
  const { id } = useParams<{ id: string }>();

  useEffect(() => {
    const fetchData = async () => {
      const data = await fetch(`/api/view/${id}`);
      const item: DataItem = await data.json();
      setData(item);
    };

    fetchData();
  }, [id]);

  useEffect(() => {
    if (data) {
      setTimeout(() => setSlide((slide + 1) % data?.slides.length), data.slides[slide].time);
    }
  }, [data, slide]);

  return (
    <div>
      <Title label={`View - ${data?.name}`} crumbs={["Home"]} />

      {data?.slides[slide] && <Slide slide={data?.slides[slide]} />}
    </div>
  );
}
