PGDMP  "                     |            PlateArt    16.1    16.1 ;    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    16893    PlateArt    DATABASE     }   CREATE DATABASE "PlateArt" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Catalan_Spain.1252';
    DROP DATABASE "PlateArt";
                postgres    false            �            1259    16901    admin    TABLE     �   CREATE TABLE public.admin (
    email character varying(255) NOT NULL,
    password character varying(255),
    signature character varying(255)
);
    DROP TABLE public.admin;
       public         heap    postgres    false            �           0    0    TABLE admin    ACL     0   REVOKE ALL ON TABLE public.admin FROM postgres;
          public          postgres    false    216            �            1259    16909    category    TABLE     p   CREATE TABLE public.category (
    code integer NOT NULL,
    name character varying(50),
    active boolean
);
    DROP TABLE public.category;
       public         heap    postgres    false            �           0    0    TABLE category    ACL     3   REVOKE ALL ON TABLE public.category FROM postgres;
          public          postgres    false    218            �            1259    16908    category_code_seq    SEQUENCE     �   CREATE SEQUENCE public.category_code_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.category_code_seq;
       public          postgres    false    218            �           0    0    category_code_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.category_code_seq OWNED BY public.category.code;
          public          postgres    false    217            �            1259    16894    client    TABLE       CREATE TABLE public.client (
    email character varying(255) NOT NULL,
    telephone character varying(15),
    name character varying(50),
    surname character varying(50),
    password character varying(255),
    address character varying(255),
    dni character varying(50)
);
    DROP TABLE public.client;
       public         heap    postgres    false            �           0    0    TABLE client    ACL     1   REVOKE ALL ON TABLE public.client FROM postgres;
          public          postgres    false    215            �            1259    16964    company    TABLE     �   CREATE TABLE public.company (
    id integer NOT NULL,
    name character varying(50),
    cif character varying(50),
    address character varying(100)
);
    DROP TABLE public.company;
       public         heap    postgres    false            �            1259    16963    company_id_seq    SEQUENCE     �   CREATE SEQUENCE public.company_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.company_id_seq;
       public          postgres    false    227            �           0    0    company_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.company_id_seq OWNED BY public.company.id;
          public          postgres    false    226            �            1259    16916    product    TABLE     -  CREATE TABLE public.product (
    code character varying(255) NOT NULL,
    name character varying(100),
    description character varying(255),
    category integer NOT NULL,
    photo character varying(255),
    price numeric(10,2),
    stock integer,
    active boolean,
    outstanding boolean
);
    DROP TABLE public.product;
       public         heap    postgres    false            �           0    0    TABLE product    ACL     2   REVOKE ALL ON TABLE public.product FROM postgres;
          public          postgres    false    220            �            1259    16915    product_category_seq    SEQUENCE     �   CREATE SEQUENCE public.product_category_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.product_category_seq;
       public          postgres    false    220            �           0    0    product_category_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.product_category_seq OWNED BY public.product.category;
          public          postgres    false    219            �            1259    16930    shopping    TABLE       CREATE TABLE public.shopping (
    id_shopping integer NOT NULL,
    client character varying(255),
    shopping_date date DEFAULT CURRENT_DATE,
    status character varying(20),
    total_price numeric(10,2),
    CONSTRAINT shopping_status_check CHECK (((status)::text = ANY ((ARRAY['pending'::character varying, 'sent'::character varying, 'cart'::character varying])::text[])))
);
    DROP TABLE public.shopping;
       public         heap    postgres    false            �           0    0    TABLE shopping    ACL     3   REVOKE ALL ON TABLE public.shopping FROM postgres;
          public          postgres    false    222            �            1259    16945    shopping_details    TABLE     �   CREATE TABLE public.shopping_details (
    id integer NOT NULL,
    shopping integer NOT NULL,
    product character varying(255),
    price_per_product numeric(10,2),
    amount integer,
    total_price numeric(10,2)
);
 $   DROP TABLE public.shopping_details;
       public         heap    postgres    false            �           0    0    TABLE shopping_details    ACL     ;   REVOKE ALL ON TABLE public.shopping_details FROM postgres;
          public          postgres    false    225            �            1259    16943    shopping_details_id_seq    SEQUENCE     �   CREATE SEQUENCE public.shopping_details_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.shopping_details_id_seq;
       public          postgres    false    225            �           0    0    shopping_details_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.shopping_details_id_seq OWNED BY public.shopping_details.id;
          public          postgres    false    223            �            1259    16944    shopping_details_shopping_seq    SEQUENCE     �   CREATE SEQUENCE public.shopping_details_shopping_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.shopping_details_shopping_seq;
       public          postgres    false    225            �           0    0    shopping_details_shopping_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.shopping_details_shopping_seq OWNED BY public.shopping_details.shopping;
          public          postgres    false    224            �            1259    16929    shopping_id_shopping_seq    SEQUENCE     �   CREATE SEQUENCE public.shopping_id_shopping_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.shopping_id_shopping_seq;
       public          postgres    false    222            �           0    0    shopping_id_shopping_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.shopping_id_shopping_seq OWNED BY public.shopping.id_shopping;
          public          postgres    false    221            7           2604    16912    category code    DEFAULT     n   ALTER TABLE ONLY public.category ALTER COLUMN code SET DEFAULT nextval('public.category_code_seq'::regclass);
 <   ALTER TABLE public.category ALTER COLUMN code DROP DEFAULT;
       public          postgres    false    217    218    218            =           2604    16967 
   company id    DEFAULT     h   ALTER TABLE ONLY public.company ALTER COLUMN id SET DEFAULT nextval('public.company_id_seq'::regclass);
 9   ALTER TABLE public.company ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    226    227    227            8           2604    16919    product category    DEFAULT     t   ALTER TABLE ONLY public.product ALTER COLUMN category SET DEFAULT nextval('public.product_category_seq'::regclass);
 ?   ALTER TABLE public.product ALTER COLUMN category DROP DEFAULT;
       public          postgres    false    219    220    220            9           2604    16933    shopping id_shopping    DEFAULT     |   ALTER TABLE ONLY public.shopping ALTER COLUMN id_shopping SET DEFAULT nextval('public.shopping_id_shopping_seq'::regclass);
 C   ALTER TABLE public.shopping ALTER COLUMN id_shopping DROP DEFAULT;
       public          postgres    false    222    221    222            ;           2604    16948    shopping_details id    DEFAULT     z   ALTER TABLE ONLY public.shopping_details ALTER COLUMN id SET DEFAULT nextval('public.shopping_details_id_seq'::regclass);
 B   ALTER TABLE public.shopping_details ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    223    225    225            <           2604    16949    shopping_details shopping    DEFAULT     �   ALTER TABLE ONLY public.shopping_details ALTER COLUMN shopping SET DEFAULT nextval('public.shopping_details_shopping_seq'::regclass);
 H   ALTER TABLE public.shopping_details ALTER COLUMN shopping DROP DEFAULT;
       public          postgres    false    225    224    225            �          0    16901    admin 
   TABLE DATA           ;   COPY public.admin (email, password, signature) FROM stdin;
    public          postgres    false    216   �A       �          0    16909    category 
   TABLE DATA           6   COPY public.category (code, name, active) FROM stdin;
    public          postgres    false    218   :B       �          0    16894    client 
   TABLE DATA           Y   COPY public.client (email, telephone, name, surname, password, address, dni) FROM stdin;
    public          postgres    false    215   �B       �          0    16964    company 
   TABLE DATA           9   COPY public.company (id, name, cif, address) FROM stdin;
    public          postgres    false    227   �B       �          0    16916    product 
   TABLE DATA           n   COPY public.product (code, name, description, category, photo, price, stock, active, outstanding) FROM stdin;
    public          postgres    false    220   C       �          0    16930    shopping 
   TABLE DATA           [   COPY public.shopping (id_shopping, client, shopping_date, status, total_price) FROM stdin;
    public          postgres    false    222   'M       �          0    16945    shopping_details 
   TABLE DATA           i   COPY public.shopping_details (id, shopping, product, price_per_product, amount, total_price) FROM stdin;
    public          postgres    false    225   DM       �           0    0    category_code_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.category_code_seq', 5, true);
          public          postgres    false    217                        0    0    company_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.company_id_seq', 1, true);
          public          postgres    false    226                       0    0    product_category_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.product_category_seq', 1, false);
          public          postgres    false    219                       0    0    shopping_details_id_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.shopping_details_id_seq', 1, false);
          public          postgres    false    223                       0    0    shopping_details_shopping_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.shopping_details_shopping_seq', 1, false);
          public          postgres    false    224                       0    0    shopping_id_shopping_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.shopping_id_shopping_seq', 1, false);
          public          postgres    false    221            B           2606    16907    admin admin_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (email);
 :   ALTER TABLE ONLY public.admin DROP CONSTRAINT admin_pkey;
       public            postgres    false    216            D           2606    16914    category category_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.category
    ADD CONSTRAINT category_pkey PRIMARY KEY (code);
 @   ALTER TABLE ONLY public.category DROP CONSTRAINT category_pkey;
       public            postgres    false    218            @           2606    16900    client client_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (email);
 <   ALTER TABLE ONLY public.client DROP CONSTRAINT client_pkey;
       public            postgres    false    215            L           2606    16969    company company_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.company
    ADD CONSTRAINT company_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.company DROP CONSTRAINT company_pkey;
       public            postgres    false    227            F           2606    16923    product product_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pkey PRIMARY KEY (code);
 >   ALTER TABLE ONLY public.product DROP CONSTRAINT product_pkey;
       public            postgres    false    220            J           2606    16951 &   shopping_details shopping_details_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.shopping_details
    ADD CONSTRAINT shopping_details_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.shopping_details DROP CONSTRAINT shopping_details_pkey;
       public            postgres    false    225            H           2606    16937    shopping shopping_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.shopping
    ADD CONSTRAINT shopping_pkey PRIMARY KEY (id_shopping);
 @   ALTER TABLE ONLY public.shopping DROP CONSTRAINT shopping_pkey;
       public            postgres    false    222            M           2606    16924    product product_category_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_category_fkey FOREIGN KEY (category) REFERENCES public.category(code);
 G   ALTER TABLE ONLY public.product DROP CONSTRAINT product_category_fkey;
       public          postgres    false    218    4676    220            N           2606    16938    shopping shopping_client_fkey    FK CONSTRAINT        ALTER TABLE ONLY public.shopping
    ADD CONSTRAINT shopping_client_fkey FOREIGN KEY (client) REFERENCES public.client(email);
 G   ALTER TABLE ONLY public.shopping DROP CONSTRAINT shopping_client_fkey;
       public          postgres    false    222    4672    215            O           2606    16957 .   shopping_details shopping_details_product_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.shopping_details
    ADD CONSTRAINT shopping_details_product_fkey FOREIGN KEY (product) REFERENCES public.product(code);
 X   ALTER TABLE ONLY public.shopping_details DROP CONSTRAINT shopping_details_product_fkey;
       public          postgres    false    220    4678    225            P           2606    16952 /   shopping_details shopping_details_shopping_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.shopping_details
    ADD CONSTRAINT shopping_details_shopping_fkey FOREIGN KEY (shopping) REFERENCES public.shopping(id_shopping);
 Y   ALTER TABLE ONLY public.shopping_details DROP CONSTRAINT shopping_details_shopping_fkey;
       public          postgres    false    225    4680    222            �   -   x�KL����L����Eɩ��ř�y�%�E��^A^:W� ͗P      �   C   x�3�t���M�)�,�2�tK�+I,���9�s3�ҁLN�ļ�D5��T ߔ�7�,3�#F��� ���      �      x������ � �      �   H   x�3��I,Iu,*Qp�/*�/J,���+��06621647�L�WHIU�IT��KMI�Q�+��S06����� ��H      �   
  x��X�r�8<�_��^D����Q�X���G���\��&�MX$� �nQ_�Y��%�:6bbf��P�����ͧO���F�֦*��t�MV��Fd�����bg�ى�
_ɍhl-���S���lm�hy[�D�?Jg�:���m����]4��xu�?EU��@o��ZFkY�Nj��)%|���{�U%4��?��۪��T4Z���C��Umɣ/��IS�YE_+��U�Cq�U&�p�씰[�s��ƍ�bk� d�}%��&qP���9��^�?t�Cﲀ�M�D�����J�� �L�T�KbC�R&�r�T._�pP��cI8V=�U���n%n2�<�Gm�17���T���*���TH�L�(�%jL*�����$�)Hyi6`:��r�_a��%�&ԕ��9 ����n�ȭ}&\��f��THT�?�[WB�k�َѝ�56�:�<G ��U�9t턳��� ��,�Nr{ё��b���R�D��2EF����0W�K��L���8�!�e�����y*�F>+��6;0��@L�7�n��D�^	]��s�m�0�o�@P�Q�C���'=�rak��=(*���6<�LP�l	���!oI��K��5�J��*�ˊ��+��R	2�u���������׭$՜����#�]*
��9��+����k%r�x�6f�r���s�����:��(�J�*�>dWX��0��D��T�n;��:�J�����ڱ�G7`��A�>�\5�h>�]�7�_���xR��}���؃��^��bC�ݪ������ܺ޺ޘ(�Z��h��͜�,�'=Q�@���V�:IUb�&5�~4����e������ ��}a�}ivʈqM�$0�P^����6�i�S8}�RS�&�'N���2�>�l���	�^*
/E�__JB��WȈ8��3�Iϒ閞�G0B3�ټx?��]�־+��>=Er�P�h[Z{��/��]ПҰ��z�x(~@v��������kpu%>�=��2ә=�=��8t'�q��xX��gT���juԺ���P�r�]>Y4�&�x ��y�a�ԛŵK�q�dAn��һ�\�!gܯe��i�)*�{V��
�i7�,��)Z�>B�1��Y��*x�v͐����~ ���0M����p'�̨�=9k��& \u���Β!ܱA�)�?�{k[�����bBYK;�����l��C�[gM5��/���>���7���A_3��Y�jP5��(�R��?��u��0���q�?�L�64u�E]�����kt���:��Rb)eh���KE*�r�]U#��I�5R��쒤
Pe.����ci��K
�G_�w2��_ol�M�m���
@��qP>�2-�+_����,���ګn�����㻧���Z�G_��D�o��m׸9�k�0�vPtBI�1�Mť�9�2�����q�?���.qr[E?�$��ɑ4��������H�^�ˊ�n���2~�ѣ}V�5 /���m?:���~��)���p�(�[,F�pǵڶ%�����\��ߘzD�.�ݦ�+͍&~����{ ��[Ɂ�PP��������56�����,i���TT��8�h;P���#U���-j��tE7�ӐBg���~�e�%(�fvޣ�(��"�`r,�I7:R�Wx[�K�%�}�S��=�OLݲ�8���*И�v��j��q�f�yi]�����)���g
3!U�r�����q�y]�֙Ъ�Q�����4��gbCy���/��3��z8C��eG�,��UO���2�����	k*��8Й�k��T؁fz��v���ZZ�H8W��������u�sE����ؑ)���v LB~�,	
O{��C\��7${�a=�������oj�n��5��
*�o�]��H�Ǌ5��Ջ^ ���{��'`/N��P���L�	#�?��� ܑB�7��>��{���;���:����Y�3KJ'׵ԍ���abq���#�I���T��Mim*E����<��aZ��R�5��Ex�)�^G�������m��K�|H�*_9�����
g�]�6��W$:!	�|)�=��t���X�4:��{��z���K"�C�a!�� 6|�	�o[�t9�;��Cu�����)��P�<JrӾ�S��u�J^�a����k ��U�L��o�X�ӡ��Kh�XCtQ���ע,��.�{|����'ى�b�Щl�4�����z��0�L�=�f�v�����ɋ��! ]��2�G55��Vt��b��po$w:A�{N���W��U�%�%�7���#r��	k(y9�:���(�ji��FG�����9�vga'X�m&���8��e�s�@�*�&�ot\�ش=D0�<� ���e��M[����x%�VS�����Amm���h�6�2뚚�v�����Nz��=���F�n��1��߲�V�6�K�ul���$�*���Л�@[�mϠ�հ,ݭ��'��İ&�j�}A�=��V���G .���ɘ�\��2Z�:��!�C��p���ȏ|�<d�Y1,:�B����i~�3�?~���?s�5      �      x������ � �      �      x������ � �     