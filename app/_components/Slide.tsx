"use client";
import { SlideData } from "@/app/api/list/route";
import Image from "next/image";

export default function Slide({ slide }: { slide: SlideData }) {
  return (
    <div>
      <Image className="mb-4 mx-auto" src={`/img/${slide.img}`} alt={slide.caption} width={300} height={300} />
      <p className="mb-4 text-2xl text-center">{slide.caption}</p>
    </div>
  );
}
